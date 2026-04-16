<?php
namespace App\Controllers\Users;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    public $authmodel;

    public function __construct()
    {
        $this->authmodel = new AuthModel();
    }
    public function dashboard()
    {
        // Check karein ki user logged in hai ya nahi
        if (!session()->get('userlogin')) {
            return redirect()->to('/login');
        }

        return view('users/dashboard');
    }
}
