<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Login nahi hai
        if (!session()->has('userlogin')) {

            // Admin URL
            if (url_is('admin/*')) {
                return redirect()->to('/wpsadmin');
            }

            // User URL
            return redirect()->to('/login');
        }

        // User admin panel open kar raha hai
        if (url_is('admin/*') && session('login_type') != 'admin') {
            return redirect()->to('/login');
        }

        // Admin privilege check
        if (session('login_type') == 'admin') {

            if (!$this->check_privilege()) {
                return redirect()->to('/authentication-failed');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

    public function check_privilege()
    {
        helper('custom');

        // Dashboard (menu_id = 1)
        if (url_is('admin/dashboard')) {
            return is_privilege(1, 1);
        }

        // ==========================
        // Admin Management (menu_id = 2)
        // ==========================
        else if (url_is('admin/members/adminindex')) {
            return is_privilege(2, 1);
        } else if (url_is('admin/members/add_admin')) {
            return is_privilege(2, 2);
        } else if (url_is('admin/members/edit_admin/*')) {
            return is_privilege(2, 3);
        } else if (url_is('admin/members/delete_admin/*')) {
            return is_privilege(2, 4);
        }

        // ==========================
        // User Management (menu_id = 3)
        // ==========================
        else if (url_is('users/members/userindex')) {
            return is_privilege(3, 1);
        } else if (url_is('users/members/add_user')) {
            return is_privilege(3, 2);
        } else if (url_is('users/members/edit_user/*')) {
            return is_privilege(3, 3);
        } else if (url_is('users/members/delete_user/*')) {
            return is_privilege(3, 4);
        }

        // ==========================
        // Product Management (menu_id = 4)
        // ==========================
        else if (url_is('users/members/adsindex')) {
            return is_privilege(4, 1);
        } else if (url_is('users/members/edit_ads/*')) {
            return is_privilege(4, 3);
        } else if (url_is('users/members/delete_ads/*')) {
            return is_privilege(4, 4);
        }

        // ==========================
        // Messages (menu_id = 5)
        // ==========================
        else if (url_is('admin/messages')) {
            return is_privilege(5, 1);
        }

        // ==========================
        // Subscribers (menu_id = 6)
        // ==========================
        else if (url_is('admin/subscribers')) {
            return is_privilege(6, 1);
        }

        // ==========================
        // Group Management (menu_id = 7)
        // ==========================
        else if (url_is('admin/groups')) {
            return is_privilege(7, 1);
        } else if (url_is('admin/groups/add')) {
            return is_privilege(7, 2);
        } else if (url_is('admin/groups/edit/*')) {
            return is_privilege(7, 3);
        } else if (url_is('admin/groups/delete/*')) {
            return is_privilege(7, 4);
        }

        // ==========================
        // Privilege Management (menu_id = 8)
        // ==========================
        else if (url_is('admin/privileges')) {
            return is_privilege(8, 1);
        } else if (url_is('admin/privileges/update/*')) {
            return is_privilege(8, 3);
        }

        // ==========================
        // Product Categories (menu_id = 9)
        // ==========================
        else if (url_is('admin/category')) {
            return is_privilege(9, 1);
        } else if (url_is('admin/category/add')) {
            return is_privilege(9, 2);
        } else if (url_is('admin/category/edit/*')) {
            return is_privilege(9, 3);
        } else if (url_is('admin/category/delete/*')) {
            return is_privilege(9, 4);
        }

        return true;
    }

}
