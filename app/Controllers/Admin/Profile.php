<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public $commonmodel;

    public function __construct()
    {
        $this->commonmodel = model('App\Models\CommonModel', false);
    }

    public function index()
    {
        $id = session('user_id');

        if (!$id) {
            return redirect()->to('/admin');
        }

        $data['profile'] = $this->commonmodel
            ->getOneRecord('admin', ['user_id' => $id]);

        return view('Admin/profile/index', $data);
    }

    public function change_password()
    {
        $id = session('user_id'); // Logged-in user id

        if (!$id) {
            return redirect()->to('/admin');
        }

        if ($this->request->getMethod() == 'POST') {

            // Validation
            $validation = $this->validate([
                /*'oldpwd' => [
                    'rules' => 'required|min_length[5]|max_length[12]',
                    'errors' => [
                        'required' => 'Old Password is required',
                        'min_length' => 'Old Password must have at least 5 characters',
                        'max_length' => 'Old Password must not have more than 12 characters'
                    ]
                ],*/
                'pwd' => [
                    'rules' => 'required|min_length[5]|max_length[12]',
                    'errors' => [
                        'required' => 'New Password is required',
                        'min_length' => 'New Password must have at least 5 characters',
                        'max_length' => 'New Password must not have more than 12 characters'
                    ]
                ],
                'cpwd' => [
                    'rules' => 'required|matches[pwd]',
                    'errors' => [
                        'required' => 'Confirm Password is required',
                        'matches' => 'Confirm Password does not match New Password'
                    ]
                ]
            ]);

            if (!$validation) {
                // Validation failed
                $data['validation'] = $this->validator;
                $data['profile'] = $this->commonmodel->getOneRecord('admin', ['user_id' => $id]);
                return view('Admin/profile/change_password', $data);
            }

            // Get current user data
            $profile = $this->commonmodel->getOneRecord('admin', ['user_id' => $id]);

            // Check old password (CI4 / PHP native)
            // $oldPassword = $this->request->getPost('oldpwd');
            // if (!password_verify($oldPassword, $profile->password)) {
            //     session()->setFlashdata('message', '<div class="alert alert-danger">Incorrect Old Password</div>');
            //     return redirect()->to('admin/profile/change_password')->withInput();
            // }

            // Update password (CI4 / PHP native)
            $newPassword = $this->request->getPost('pwd');
            $updated = $this->commonmodel->updateRecord(
                'admin',
                ['password' => password_hash($newPassword, PASSWORD_DEFAULT)],
                ['user_id' => $id]
            );

            if ($updated) {
                // Flash message set kiya
                session()->setFlashdata('message', '<div class="alert alert-success text-center">Password changed successfully.</div>');

                // Logout kiya
                session()->destroy();

                // Redirect ki jagah flag ke sath view load kiya taki JS chal sake
                $data['password_changed'] = true;
                $data['profile'] = $this->commonmodel->getOneRecord('admin', ['user_id' => $id]);
                return view('Admin/profile/change_password', $data);

            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger">Something went wrong. Try again.</div>');
                return redirect()->to('admin/profile/change_password');
            }
        } else {
            // GET request, show form
            $data['profile'] = $this->commonmodel->getOneRecord('admin', ['user_id' => $id]);
            return view('Admin/profile/change_password', $data);
        }
    }

    public function edit_profile($id)
    {
        if ($this->request->getMethod() == 'POST') {
            // echo "<pre>"; print_r($_FILES); exit;
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Your Full name is required'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'You must enter a valid email',
                        //   'is_unique'=>'Email already taken'
                    ]
                ],
                'phone' => [
                    'rules' => 'required|numeric|min_length[10]|max_length[10]',
                    'errors' => [
                        'required' => 'Phone is required',
                        'numeric' => 'You must enter numeric value',
                        'min_length' => 'Phone Number must be 10 digit in length',
                        'max_length' => 'Phone Number must not have more than 10 digit in length'
                    ]
                ],

                'address' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Address is required',
                        'min_length' => 'Address must be at least 5 characters'
                    ]
                ],

            ]);
            if (!$validation) {
                $data['validation'] = $this->validator;
                //return view('admin/users/add_user',$this->data);
            } else {
                $post = []; // 🔥 YE LINE ADD KARO

                if ($_FILES['image']['name'] != '') {
                    if ($img = $this->request->getFile('image')) {
                        $imgname = $img->getName();
                        if ($img->isValid() && !$img->hasMoved()) {
                            $ext = explode('.', $imgname);
                            $ext = end($ext);
                            $newName = 'u_' . time() . '.' . $ext;
                            $img->move(FCPATH . 'assets/upload/users/', $newName);
                        }
                    }
                    $post['image'] = $newName;
                }

                $post['name'] = $this->request->getPost('name');
                $post['email'] = $this->request->getPost('email');
                $post['phone'] = $this->request->getPost('phone');
                $post['status'] = $this->request->getPost('status');
                $post['address'] = $this->request->getPost('address');
                $post['update_by'] = session('user_id');
                $post['updated'] = date('Y-m-d H:i:s');

                $updated = $this->commonmodel->updateRecord('admin', $post, ['user_id' => $id]);

                if ($updated) {

                    // SESSION UPDATE
                    session()->set([
                        'name' => $post['name'],
                        'email' => $post['email'],
                        'phone' => $post['phone'],
                        'address' => $post['address'],
                    ]);

                    if (isset($post['image'])) {
                        session()->set('image', $post['image']);
                    }

                    session()->setFlashdata(['message' => 'User Updated Successfully', 'type' => 'success']);
                } else {
                    session()->setFlashdata(['message' => 'Something went wrong. Please Try After Sometimes...', 'type' => 'danger']);
                }

                return redirect()->to('admin/profile');
            }
        }
        $data['user'] = $this->commonmodel->getOneRecord('admin', ['user_id' => $id]);
        return view('Admin/profile/edit_profile', $data);
    }
}
