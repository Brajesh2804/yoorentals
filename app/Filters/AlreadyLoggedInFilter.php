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

            // Admin already logged in
            if (session('login_type') == 'admin') {
                return redirect()->to('/admin/dashboard');
            }

            // User already logged in
            if (session('login_type') == 'user') {
                return redirect()->to('/');
            }
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}