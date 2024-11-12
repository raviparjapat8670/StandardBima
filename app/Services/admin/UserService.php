<?php

namespace App\Services\admin;

use App\Models\User;
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


        $data['password'] = Hash::make($data['password']); // Hash password before storing
        return User::create($data);
    }


    public function getUsers(array $data){

        return User::paginate(10);

    }


}