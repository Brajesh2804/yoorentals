<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public $commonmodel;

    public function __construct()
    {
        $this->commonmodel = model('App\Models\CommonModel', false);
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

        return view('users/profile', $data);
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

            return redirect()->to('users/updateProfile')->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}