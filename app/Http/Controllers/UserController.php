<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function login()
    {
        return view('user.login');
    }

    public function logout()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.login');
    }
}
