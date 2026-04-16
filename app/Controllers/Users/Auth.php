<?php

namespace App\Controllers\Users;
use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\AuthModel;
use App\Libraries\Hash;
class Auth extends BaseController
{
    protected $commonModel;
    protected $authModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel();
        $this->authModel = new AuthModel();
        helper(['form', 'url']);
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
                return view('users/Auth/login', $data);
            } else {
                // print_r($_POST); exit;
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $user_info = $this->authModel->is_users_validate($email);

                // if (!isset($user_info->id)) {
                //     // print_r($user_info); exit;
                //     session()->setFlashdata('message', '<div class="alert alert-danger">Inactive user. Contact administrator...</div>');
                //     return redirect()->to(base_url('login'));
                // }

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

        return view('users/Auth/login', $data);
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

        return view('users/register', $data);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'You have been logged out.');
    }
}