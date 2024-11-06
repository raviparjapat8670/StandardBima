<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index()
    {

        return view('admin.users.index');
    }

    public function login(Request $request)
    {

        if (Auth::check()) {
            // If logged in, continue with the Dashboard
            return redirect()->route('admin.dash');
        }
        // If the request is a POST request, handle the form submission
        if ($request->isMethod('post')) {
            // Validate the request using the UserLoginRequest
            $validatedData = $request->validate([
                'mobile' => 'required|digits:10',
                'password' => 'required|min:8',
            ], [
                'mobile.required' => 'Please enter your mobile number.',
                'mobile.digits' => 'Please enter a valid 10-digit mobile number.',
                'password.required' => 'Please enter your password.',
                'password.min' => 'Password must be at least 8 characters long.',
            ]);


            // Prepare the credentials array for Auth::attempt
            $credentials = [
                'mobile' => $request->mobile,  // Assuming mobile is a unique identifier
                'password' => $request->password,
            ];

            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                // Authentication passed, redirect to intended location
                return redirect()->route('admin.dash');
            }

            // If authentication fails, redirect back with error message
            return back()->withErrors([
                'error' => 'The provided credentials do not match our records.',
            ])->withInput(); // Retain the old input
        }

        // If the request is not POST (GET request), show the login form
        return view('admin.login');
    }
    public function logout()
    {

        // Log out the user
        Auth::logout();

        // Redirect the user to the homepage or login page
        return redirect()->route('admin.login');
    }
}
