<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        $data = Category::orderBy('id')->get();

        return view('home.index', ['data' => $data]);
    }

    public function delete($id)
    {
        echo 1;die;
    }
}
