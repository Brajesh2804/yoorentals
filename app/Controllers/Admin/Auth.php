<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public $authmodel;

    public function __construct()
    {
        $this->authmodel = new AuthModel();
    }

    
    public function login()
    {
        $data = [];// 

        // Agar POST request hai
        if ($this->request->getMethod() == 'POST') {
            // print_r($_POST); exit;
            $validation = $this->validate([
                'email' => [
                    'rules' => 'required|valid_email|is_not_unique[users.email]',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Enter a valid email address',
                        'is_not_unique' => 'This email is not registered on your service'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[12]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password must have atleast 5 characters in length',
                        'max_length' => 'Password must not have more than 12 characters in length'
                    ]
                ]
            ]);

            if (!$validation) {
                // Validation failed
                $data['validation'] = $this->validator;
                return view('Auth/login', $data);
            } else {
                // print_r($_POST); exit;
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $user_info = $this->authmodel->isvalidate($email);

                if (!isset($user_info->id)) {
                    // print_r($user_info); exit;
                    session()->setFlashdata('message', '<div class="alert alert-danger">Inactive user. Contact administrator...</div>');
                    return redirect()->to(base_url('admin'));
                }

                $check_password = Hash::check($password, $user_info->password);
                if ($check_password) {
                    $sessionData = array(
                        'id' => $user_info->id,
                        'name' => $user_info->name,
                        'email' => $user_info->email,
                        'password' => $user_info->password,
                        // 'phone' => $user_info->phone,
                        // 'address' => $user_info->address,
                        // 'image' => $user_info->image,
                        // 'privilege_id' => $user_info->privilege_id,
                        // 'status' => $user_info->status,
                        'userlogin' => true,
                    );
                    session()->set($sessionData);
                    return redirect()->to('/');
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-danger">Incorrect Password</div>');
                    return redirect()->to('/login')->withInput();
                }
                // print_r($user_info);exit;
            }
        }

        return view('admin/Auth/login', $data);
    }

    public function register()
    {
        $data = [];

        if ($this->request->getMethod() == 'POST') {

            $validation = $this->validate([
                'name' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'Name is required',
                        'min_length' => 'Name must be at least 3 characters'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Enter a valid email',
                        'is_unique' => 'Email already exists'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[12]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password must be at least 5 characters',
                        'max_length' => 'Password must not exceed 12 characters'
                    ]
                ]
            ]);

            // ❌ FIX HERE
            if (!$validation) {
                return redirect()->back()
                    ->withInput()
                    ->with('validation', $this->validator);
            }

            // ✅ Save
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'status' => 1
            ];

            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->insert($data);
            session()->setFlashdata(
                'message',
                '<div class="alert alert-success">Registered Successfully</div>'
            );

            return redirect()->to(base_url('/'));
        }

        return view('admin/register', $data);
    }

    public function category()
    {
        // Sirf login user hi dekh sake
        if (!session()->get('userlogin')) {
            return redirect()->to(base_url('login'));
        }

        return view('properties/category');
    }

    public function save_ad()
    {
        // 1. Check karein ki user login hai ya nahi
        if (!session()->get('userlogin')) {
            return redirect()->to(base_url('login'));
        }

        // 2. Files upload logic
        $imgFiles = $this->request->getFileMultiple('images');
        $imgNames = [];

        if ($imgFiles) {
            foreach ($imgFiles as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/ads', $newName);
                    $imgNames[] = $newName;
                }
            }
        }

        // 3. Data Prepare karein (owner_id aur phone ke sath)
        $data = [
            'owner_id' => session()->get('id'), // Login user ki ID yahan save hogi
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'price' => $this->request->getPost('price'),
            'location' => $this->request->getPost('location'),
            'phone' => $this->request->getPost('phone'), // Phone number field
            'description' => $this->request->getPost('description'),
            'images' => implode(',', $imgNames),
        ];

        // 4. Database mein insert karein
        $db = \Config\Database::connect();
        $db->table('ads')->insert($data);

        session()->setFlashdata('message', 'Ad Posted Successfully!');

        // Direct home par bhej rahe hain
        return redirect()->to(base_url('/'));
    }
    public function post_ad($category = null)
    {
        if (!session()->get('userlogin')) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'category' => $category,
            'title' => 'Post Ad for ' . ucfirst($category)
        ];

        // ✅ Aapne kaha file yahan hai, isliye path ye rahega:
        return view('admin/items/post_ad_form', $data);
    }

    public function item_details($id)
    {
        $db = \Config\Database::connect();

        // Query with JOIN to get owner details
        $ad = $db->table('ads')
            ->select('ads.*, users.name as owner_name, users.image as owner_photo')
            ->join('users', 'users.id = ads.owner_id', 'left') // ads.owner_id check karlein
            ->where('ads.id', $id)
            ->get()
            ->getRow();

        if (!$ad) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Ad not found!");
        }

        $data = [
            'ad' => $ad,
            'title' => $ad->title
        ];

        return view('admin/items/item_details', $data);
    }

    public function send_message()
    {
        // 1. Check Login
        if (!session()->get('userlogin')) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Please login first']);
            }
            return redirect()->to('login');
        }

        $db = \Config\Database::connect();

        // 2. Receiver ID Logic
        $receiver = $this->request->getPost('receiver_id');
        $ad_id = $this->request->getPost('ad_id');

        if (empty($receiver) || $receiver == 0) {
            $ad = $db->table('ads')->where('id', $ad_id)->get()->getRow();
            // Check karein ki ads table mein column ka naam 'owner_id' hai ya 'user_id'
            $receiver = isset($ad->owner_id) ? $ad->owner_id : (isset($ad->user_id) ? $ad->user_id : 0);
        }

        // 3. Data Preparation
        $data = [
            'ad_id' => $ad_id,
            'sender_id' => session()->get('id'),
            'receiver_id' => $receiver,
            'message' => $this->request->getPost('message'),
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s') // Timing ke liye best hai
        ];

        // 4. Insert Data
        $db->table('messages')->insert($data);

        // 5. AJAX Response Support
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Message sent successfully!'
            ]);
        }

        // 6. Normal Form Fallback
        return redirect()->back()->with('message', 'Message sent!');
    }

    public function view_messages($ad_id = null, $user_id = null)
    {
        if (!session()->get('userlogin'))
            return redirect()->to(base_url('login'));

        $db = \Config\Database::connect();
        $my_id = session()->get('id');

        // --- STEP 1: Chat List (Owner ke liye saare Customers ki list) ---
        // Hum query ko simple kar rahe hain taaki data 100% aaye
        $data['chat_list'] = $db->query("
        SELECT 
            m.ad_id, 
            a.title as ad_title, 
            u.id as other_user_id, 
            u.name as user_name,
            m.message as last_msg, 
            m.created_at as last_time
        FROM messages m
        JOIN ads a ON a.id = m.ad_id
        JOIN users u ON u.id = IF(m.sender_id = $my_id, m.receiver_id, m.sender_id)
        WHERE m.sender_id = $my_id OR m.receiver_id = $my_id
        AND m.id IN (SELECT MAX(id) FROM messages GROUP BY ad_id, IF(sender_id = $my_id, receiver_id, sender_id))
        ORDER BY m.created_at DESC
    ")->getResult();

        // --- STEP 2: Active Chat Logic ---
        if ($ad_id !== null && $user_id !== null) {
            $data['active_chat'] = true;
            $data['active_ad'] = $ad_id;

            // Samne wale user ka data
            $data['other_user'] = $db->table('users')->where('id', $user_id)->get()->getRow();

            // Ad ka title
            $ad = $db->table('ads')->where('id', $ad_id)->get()->getRow();
            $data['ad_title'] = $ad ? $ad->title : 'Item';

            // Saare messages load karein (Conversation)
            $data['messages'] = $db->table('messages')
                ->groupStart()
                ->where(['sender_id' => $my_id, 'receiver_id' => $user_id, 'ad_id' => $ad_id])
                ->orWhere(['sender_id' => $user_id, 'receiver_id' => $my_id, 'ad_id' => $ad_id])
                ->groupEnd()
                ->orderBy('id', 'ASC')
                ->get()->getResult();

            // Messages ko READ mark karein
            $db->table('messages')
                ->where(['receiver_id' => $my_id, 'sender_id' => $user_id, 'ad_id' => $ad_id])
                ->update(['is_read' => 1]);
        }

        return view('admin/items/messages_view', $data);
    }

    public function profile()
    {
        $db = \Config\Database::connect();
        $userId = session()->get('id');

        // 1. Database se user ka saara fresh data nikalna
        $user = $db->table('users')->where('id', $userId)->get()->getRow();

        // 2. Total Rents count (Agar bookings table nahi hai toh 0 set karega)
        try {
            $totalRents = $db->table('bookings')->where('user_id', $userId)->countAllResults();
        } catch (\Exception $e) {
            $totalRents = 0; // Table nahi hone par error nahi dega, 0 dikhayega
        }

        // 3. Check karein agar created_at table mein hai, nahi toh default value dein
        $joinedDate = isset($user->created_at) ? date('M Y', strtotime($user->created_at)) : 'Oct 2023';

        $data = [
            'user' => $user,
            'totalRents' => $totalRents,
            'joinedDate' => $joinedDate
        ];

        return view('admin/profile', $data);
    }
    public function updateProfile()
    {
        $session = session();
        $db = \Config\Database::connect();
        $userId = $session->get('id');

        // 1. Validation Rules
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[users.email,id,$userId]",
            'phone' => 'required|numeric|min_length[10]',
        ];

        // Agar password fill kiya hai toh hi validate karein
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['confirm_password'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Prepare Data
        $updateData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        // 3. Hash Password (agar change kiya hai)
        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // 4. Update Database
        $builder = $db->table('users');
        $builder->where('id', $userId);

        if ($builder->update($updateData)) {

            // 5. Update Session Data (taaki header/profile me turant dikhe)
            $session->set([
                'name' => $updateData['name'],
                'email' => $updateData['email'],
                'phone' => $updateData['phone']
            ]);

            return redirect()->to('admin/updateProfile')->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function dashboard()
    {
        // Check karein ki user logged in hai ya nahi
        if (!session()->get('userlogin')) {
            return redirect()->to('/login');
        }

        return view('admin/_layouts/dashboard');
    }

    public function admin_dashboard()
    {
        // Check karein ki user logged in hai ya nahi
        if (!session()->get('userlogin')) {
            return redirect()->to('/login');
        }

        return view('admin/admin_dashboard');
    }


    public function delete_ad($id)
    {
        $db = \Config\Database::connect();
        $my_id = session()->get('id');

        // Security check: Sirf wahi banda delete kar sake jiski ad hai
        $db->table('ads')
            ->where('id', $id)
            ->where('owner_id', $my_id) // owner_id ya user_id jo bhi aap use kar rahe hain
            ->update(['status' => 0]); // Delete nahi, status update

        return redirect()->back()->with('msg', 'Ad removed successfully');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}