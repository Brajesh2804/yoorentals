<?php

namespace App\Libraries;

class Hash
{
    // Password ko encrypt karne ke liye
    public static function make($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Password check karne ke liye (Login ke waqt)
    public static function check($password, $db_password)
    {
        if (password_verify($password, $db_password)) {
            return true;
        } else {
            return false;
        }
    }
}