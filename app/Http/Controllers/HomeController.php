<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.dashboard');
    }

    public function indexUser()
    {
        return view('user.dashboard');
    }
}
