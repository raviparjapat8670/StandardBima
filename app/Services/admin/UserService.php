<?php

namespace App\Services\admin;

use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function CreateUser(array $data)
    {

        if (empty($data))
            return false;

        $data['password'] = Hash::make($data['mobile']); // Hash password before storing
        $data['permission'] = json_encode($data['permissions']);
        $user = User::create($data);
        // Log the activity
        UserActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity_type' => 'user-add',
            'activity_id' => $user->id,
            'message' => "User {$data['fname']} {$data['lname']} has been added.",
        ]);
        return $user;
    }


    public function getUsers(array $data)
    {

        return User::paginate(10);
    }

    public function getUserById($id)
    {
        if (empty($id))
            return false;

        return User::find($id);
    }


    public function EditUser(array $data)
    {

        if (empty($data['id']))
            return false;


        $user = User::find($data['id']);

        if (!$user)
            return false;

        $user->fname = $data['fname'];
        $user->lname = $data['lname'];
        $user->role = $data['role'];
        $user->gender = $data['gender'];
        $user->permission = json_encode($data['permissions']);
        $user->save();
        // Log the activity
        UserActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity_type' => 'user-edit',
            'activity_id' => $data['id'],
            'message' => "User {$data['fname']} {$data['lname']} has been updated.",
        ]);
        return $user;
    }

   
}
