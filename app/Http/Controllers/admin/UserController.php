<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\user\CreateUserRequest;
use App\Http\Requests\admin\user\EditUserRequest;
use App\Http\Requests\admin\user\GetUserPermissionRequest;
use App\Http\Requests\admin\user\GetUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\admin\UserService;
use Illuminate\Support\Facades\Crypt;


class UserController extends Controller
{
    //

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(GetUserRequest $request)
    {

        $validated = $request->validated();
        // Retrieve the list of users from the UserService
        $users = $this->userService->getUsers($validated);
        return view('admin.users.index', compact('users'));
    }


    public function CreateUser(CreateUserRequest $request)
    {

        if ($request->isMethod('get')) {
            $permissions = config('permissions');
            // For GET request: Show the form
            return view('admin.users.create',compact('permissions'));  // This is your form view
        }


        // Use the CreateUserRequest only for POST requests
        $validated = $request->validated(); // Manually validate on POST request
        $validated['permissions']= $request->input('permissions');

        // Retrieve the cretaed of user from the UserService
        $users = $this->userService->CreateUser($validated);

        if ($users) {
            session()->flash('success', 'User has been created successfully.');
            return redirect()->route('admin.users');
        }

        session()->flash('error', 'Sorry something went wrong! Please try again later.');
        return redirect()->route('admin.users');
    }


    // Show user details or edit the user
    public function EditUser(EditUserRequest $request, $id)
    {
        if ($request->isMethod('get')) {
            // Decrypt the ID
            $id = Crypt::decrypt($id);
            $permissions = config('permissions');
            $user = $this->userService->getUserById($id); // Get the user or throw 404 if not found
            $user->permission=json_decode($user->permission);
            // If the request is GET, display the user details with the edit form
            return view('admin.users.edit', compact('user','permissions'));
        }

        // If the request is POST, update the user details
        $validated = $request->validated(); // Manually validate on POST request
        // Update the user

        $validated['id'] = $request->input('id');
        $validated['permissions']= $request->input('permissions');
        // Retrieve the edit of user from the UserService
        $user = $this->userService->EditUser($validated);
        if ($user) {
            // Redirect back to the user details page with a success message
            session()->flash('success', 'User details updated successfully.');
            return redirect()->route('admin.users');
        }
        // Redirect back to the user details page with a error message
        session()->flash('error', 'Sorry something went wrong! Please try again later.');
        return redirect()->route('admin.users');
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
