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
        $userId = session()->get('user_id');

        // 1. Database se user ka saara fresh data nikalna
        $user = $db->table('users')->where('user_id', $userId)->get()->getRow();

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

        return view('users/profile/profile', $data);
    }
    public function updateProfile()
    {
        $session = session();
        $db = \Config\Database::connect();
        $userId = $session->get('user_id');

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[users.email,user_id,$userId]",
            'phone' => 'required|numeric|min_length[10]',
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['confirm_password'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        $img = $this->request->getFile('image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $oldUser = $db->table('users')->where('user_id', $userId)->get()->getRow();
            if (!empty($oldUser->image) && file_exists('uploads/profile/' . $oldUser->image)) {
                @unlink('uploads/profile/' . $oldUser->image);
            }

            $newName = $img->getRandomName();
            $img->move('uploads/profile', $newName);
            $updateData['image'] = $newName;
        }

        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $builder = $db->table('users');
        $builder->where('user_id', $userId);

        if ($builder->update($updateData)) {
            // Updated Session Data
            $sessionData = [
                'name' => $updateData['name'],
                'email' => $updateData['email'],
                'phone' => $updateData['phone']
            ];

            // Agar image update hui hai toh naya naam, warna purana hi rehne do
            if (isset($updateData['image'])) {
                $sessionData['image'] = $updateData['image'];
            }

            $session->set($sessionData);

            return redirect()->to(base_url('users/profile'))->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}