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
        if (!session()->get('userlogin')) {
            return redirect()->to('/admin');
        }

        // if (session()->get('role') != '1') {
        //     return redirect()->to('/unauthorized');
        // }

        return view('admin/index');
    }

}
