<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    function makepassword($password="password"){
 
        $hashedPassword = Hash::make($password); // Hash the passwordreturn
         echo $hashedPassword;
         exit;
    }
}
