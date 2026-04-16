<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
   public function home()
    {
        
        return view('home');
    }
}