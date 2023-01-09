<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('layouts.auth.signin');
    }

    function signup()
    {
        return view('layouts.auth.signup');
    }

    function validate_signup(Request $request)
    {
        $request->validate([
            'name'         =>   'required|unique:users',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
            'image'        =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'assets/img';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'image' =>  $data['image']

        ]);

        return redirect('signin')->with('message', 'Sign up Completed, now you can login!');
    }

    function validate_signin(Request $request)
    {
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect('dashboard');
        }

        return redirect('signin')->with('error', 'sign in details are not valid');
    }

    function dashboard()
    {
        if(Auth::check())
        {
            return view('layouts.dashboard');
        }

        return redirect('signin')->with('error', 'you are not allowed to access');
    }

    function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect('signin')->with('info', 'you loged out from your account');
    }
}
