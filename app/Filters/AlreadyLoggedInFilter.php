<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AlreadyLoggedInFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('userlogin')) {

            if (session('login_type') == 'admin') {
                return redirect()->to('/admin/dashboard');
            }

            if (session('login_type') == 'user') {
                return redirect()->to('/users/dashboard');
            }

        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}