<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function getLogin()
    {
        return view('user.login');
    }

    public function postLogin()
    {
        return view('user.login');
    }

    public function logout()
    {
        return view('user.login');
    }

    public function getRegister()
    {
        request()->session()->flash('success', config('messages.SIGN_UP_SUCCESS'));
        return view('user.register');
    }

    public function postRegister(SignupRequest $request)
    {
        try {

            $user = User::create([
                'email' => $request->email,
                'full_name' => $request->full_name,
                'username' => $request->username,
                'password' => $request->password,
            ]);

            $user->save();

            request()->session()->flash('success', config('messages.SIGN_UP_SUCCESS'));

            return redirect()->route('user.getLogin');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            request()->session()->flash('error', config('messages.SYSTEM_ERROR'));
        }

        return redirect()->route('user.getRegister');
    }
}
