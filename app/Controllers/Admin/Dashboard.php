<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    public $authmodel;
    public function __construct()
    {
        $this->authmodel = model('App\Models\AuthModel', false);
    }
    public function index()
    {
        $db = \Config\Database::connect();

        $data['total_users'] = $db->table('users')->countAllResults();

        $data['total_ads'] = $db->table('ads')->countAllResults();

        $data['active_ads'] = $db->table('ads')
            ->where('status', 1)
            ->countAllResults();

        $data['total_blocked_users'] = $db->table('users')
            ->where('is_blocked', 1)
            ->countAllResults();

        return view('admin/index', $data);
    }

    public function members()
    {
        if (!session()->get('userlogin')) {
            return redirect()->to('/admin');
        }

        $db = \Config\Database::connect();

        $data['members'] = $db->table('users')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResult();

        return view('admin/members/user', $data);
    }

    public function deleteMember($id)
    {
        if (!session()->get('userlogin')) {
            return redirect()->to('/admin');
        }

        $db = \Config\Database::connect();

        $db->table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->to(base_url('admin/members'));
    }

    public function viewMember($id)
    {
        $db = \Config\Database::connect();

        $data['member'] = $db->table('users')
            ->where('id', $id)
            ->get()
            ->getRow();

        if (!$data['member']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/members/view', $data);
    }

    public function editMember($id)
    {
        $db = \Config\Database::connect();

        $data['member'] = $db->table('users')
            ->where('id', $id)
            ->get()
            ->getRow();

        return view('admin/members/edit', $data);
    }

    public function admins()
    {
        $db = \Config\Database::connect();

        $data['admins'] = $db->table('admin a')
            ->select('a.*, g.group_name')
            ->join('tbl_group g', 'g.group_id = a.group_id', 'left')
            ->orderBy('a.user_id', 'ASC')
            ->get()
            ->getResult();

        return view('admin/members/adminindex', $data);
    }

    public function deleteAdmin($id)
    {
        // Login check
        if (!session()->get('userlogin')) {
            return redirect()->to('/wpsadmin');
        }

        $db = \Config\Database::connect();

        // Admin data nikalo
        $admin = $db->table('admin')
            ->where('user_id', $id)
            ->get()
            ->getRow();

        // Agar admin nahi mila
        if (!$admin) {
            session()->setFlashdata(
                'message',
                '<div class="alert alert-danger">Admin not found.</div>'
            );

            return redirect()->back();
        }

        // Super Admin Protection
        if ($admin->group_id == 1) {

            session()->setFlashdata(
                'message',
                '<div class="alert alert-danger">
                Super Admin cannot be deleted.
            </div>'
            );

            return redirect()->back();
        }

        // Delete Admin
        $db->table('admin')
            ->where('user_id', $id)
            ->delete();

        session()->setFlashdata(
            'message',
            '<div class="alert alert-success">
            Admin deleted successfully.
        </div>'
        );

        return redirect()->back();
    }

    public function viewAdmin($id)
    {
        $db = \Config\Database::connect();

        $data['admin'] = $db->table('admin a')
            ->select('a.*, g.group_name')
            ->join('tbl_group g', 'g.group_id = a.group_id', 'left')
            ->where('a.user_id', $id)
            ->get()
            ->getRow();

        if (!$data['admin']) {
            return redirect()->back();
        }

        return view('admin/members/view_admin', $data);
    }
    public function editAdmin($id)
    {
        $db = \Config\Database::connect();

        $admin = $db->table('admin')
            ->where('user_id', $id)
            ->get()
            ->getRow();

        if (!$admin) {
            return redirect()->back();
        }

        // Update
        if ($this->request->getMethod() == 'POST') {

            $updateData = [
                'name' => $this->request->getPost('name'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
            ];

            // Super Admin protection
            if ($admin->group_id != 1) {

                $updateData['email'] = $this->request->getPost('email');
                $updateData['group_id'] = $this->request->getPost('group_id');
                $updateData['status'] = $this->request->getPost('status');
            }

            // Image Upload
            $image = $this->request->getFile('image');

            if ($image && $image->isValid() && !$image->hasMoved()) {

                $newName = $image->getRandomName();

                $image->move(
                    FCPATH . 'uploads/profile/',
                    $newName
                );

                $updateData['image'] = $newName;
            }

            $db->table('admin')->where('user_id', $id)->update($updateData);
            if (session('user_id') == $id) {

                session()->set([
                    'name' => $updateData['name'],
                    'phone' => $updateData['phone'],
                    'address' => $updateData['address']
                ]);

                if (isset($updateData['image'])) {
                    session()->set('image', $updateData['image']);
                }

                if (isset($updateData['email'])) {
                    session()->set('email', $updateData['email']);
                }
            }

            session()->setFlashdata(
                'message',
                '<div class="alert alert-success">
                Admin updated successfully.
            </div>'
            );

            return redirect()->to('admin/members/adminindex');
        }

        $data['admin'] = $admin;

        $data['groups'] = $db->table('tbl_group')
            ->where('status', 1)
            ->get()
            ->getResult();

        return view('admin/members/edit_admin', $data);
    }

    public function addAdmin()
    {
        if (!session()->get('userlogin')) {
            return redirect()->to('/admin');
        }

        $db = \Config\Database::connect();

        // Group list dropdown ke liye
        $data['groups'] = $db->table('tbl_group')
            ->where('status', 1)
            ->get()
            ->getResult();

        if ($this->request->getMethod() == 'POST') {

            $rules = [
                'name' => 'required',
                'email' => 'required|valid_email|is_unique[admin.email]',
                'password' => 'required|min_length[6]',
                'cpassword' => 'required|matches[password]',
                'group_id' => 'required',
                'status' => 'required',
            ];

            if (!$this->validate($rules)) {

                $data['validation'] = $this->validator;
                return view('admin/members/add_admin', $data);
            }

            // Image Upload
            $imageName = '';

            $image = $this->request->getFile('image');

            if ($image && $image->isValid() && !$image->hasMoved()) {

                $imageName = $image->getRandomName();

                $image->move(
                    FCPATH . 'uploads/profile/',
                    $imageName
                );
            }

            // Insert Data
            $insertData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                ),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
                'group_id' => $this->request->getPost('group_id'),
                'status' => $this->request->getPost('status'),
                'image' => $imageName,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $db->table('admin')->insert($insertData);

            session()->setFlashdata(
                'message',
                '<div class="alert alert-success">
                Admin Added Successfully.
            </div>'
            );

            return redirect()->to(base_url('admin/members/adminindex'));
        }

        return view('admin/members/add_admin', $data);
    }
    /******************************************************************************/
    public function users()
    {
        if (!session()->get('userlogin')) {
            return redirect()->to('/wpsadmin');
        }

        $db = \Config\Database::connect();

        $data['users'] = $db->table('users')
            ->orderBy('user_id', 'ASC')
            ->get()
            ->getResult();

        return view('users/members/userindex', $data);
    }

    public function viewUser($id)
    {
        $db = \Config\Database::connect();

        $data['user'] = $db->table('users')
            ->where('user_id', $id)
            ->get()
            ->getRow();

        if (!$data['user']) {
            return redirect()->back();
        }

        return view('users/members/view_user', $data);
    }

    public function editUser($id)
    {
        $db = \Config\Database::connect();

        $user = $db->table('users')
            ->where('user_id', $id)
            ->get()
            ->getRow();

        if (!$user) {
            return redirect()->back();
        }

        if ($this->request->getMethod() == 'POST') {

            $updateData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
                'status' => $this->request->getPost('status'),
            ];

            $db->table('users')
                ->where('user_id', $id)
                ->update($updateData);

            return redirect()->to(base_url('admin/users'));
        }

        $data['user'] = $user;

        return view('users/members/edit_user', $data);
    }



    public function blockUser($id)
    {
        $db = \Config\Database::connect();

        $user = $db->table('users')
            ->where('user_id', $id)
            ->get()
            ->getRow();

        if (!$user) {
            return redirect()->back();
        }

        if ($this->request->getMethod() == 'POST') {

            $reason = $this->request->getPost('block_reason');

            $db->table('users')
                ->where('user_id', $id)
                ->update([
                    'is_blocked' => 1,
                    'block_reason' => $reason
                ]);

            return redirect()->to(base_url('users/members/userindex'))
                ->with(
                    'message',
                    '<div class="alert alert-success">User blocked successfully.</div>'
                );
        }

        $data['user'] = $user;

        return view('users/members/block_user', $data);
    }

    public function unblockUser($id)
    {
        $db = \Config\Database::connect();

        $db->table('users')
            ->where('user_id', $id)
            ->update(['is_blocked' => 0]);

        return redirect()->back();
    }

    public function userAds($user_id)
    {
        $db = \Config\Database::connect();

        $data['ads'] = $db->table('ads')
            ->where('owner_id', $user_id)
            ->get()
            ->getResult();

        return view('users/members/user_ads', $data);
    }

    public function allAds()
    {
        $db = \Config\Database::connect();

        $data['ads'] = $db->table('ads')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResult();

        return view('users/members/adsindex', $data);
    }

    public function deleteUser($id)
    {
        $db = \Config\Database::connect();

        $user = $db->table('users')
            ->where('user_id', $id)
            ->get()
            ->getRow();

        if (!$user) {
            return redirect()->back();
        }

        // Profile image delete karne ke liye
        if (!empty($user->image) && $user->image != '0') {

            $imagePath = FCPATH . 'uploads/profile/' . $user->image;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // User delete
        $db->table('users')
            ->where('user_id', $id)
            ->delete();

        return redirect()->back()->with(
            'message',
            '<div class="alert alert-success">User deleted successfully.</div>'
        );
    }

}