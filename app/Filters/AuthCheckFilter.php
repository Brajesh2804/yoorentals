<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        $msg = '';        
        if(!session()->has('userlogin')){
            // if(url_is('admin/*')){
            //     $msg = '<div class="alert alert-danger">You must be logged in!</div>';
            // }
            //return redirect()->to('/404')->with('message', $msg);
            // return redirect()->to('/admin?access=out')->with('message', $msg);
            return redirect()->to('/login');
        }else{
            // $menuId = $this->check_privilege();
            // if(! $menuId){
            //     return redirect()->to('/authentication-failed');
            // }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

    public function check_privilege(){
        helper('custom');

         if(url_is('admin/users')){
            return is_privilege(1);
        }else if(url_is('admin/add_user')){
            return is_privilege(1,2);
        }else if(url_is('admin/edit_user/*')){
            return is_privilege(1,3);
        }else if(url_is('admin/user_profile/*')){
            return is_privilege(1,4);
        }else if(url_is('admin/user_delete/*')){
            return is_privilege(1,5);
        }
        
        return true; //for common url
    }
}
    