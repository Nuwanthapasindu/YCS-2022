<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\Mail\new_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    public static function new_account_notify($email,$name,$password,$role){
        $data = [
            'email'=>$email,
            'name'=>$name,
            'password'=>$password,
            'role'=>$role,
        ];

        Mail::to($email)->send(new new_account($data));
    }

}
