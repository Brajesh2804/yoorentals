<?php

if (!function_exists('is_privilege')) {

    function is_privilege($menu_id)
    {
        if (!session()->has('userlogin')) {
            return false;
        }

        $auth = model('App\Models\AuthModel');

        $data = $auth->is_user_privilege(
            session('group_id'),
            $menu_id
        );

        return !empty($data);
    }
}