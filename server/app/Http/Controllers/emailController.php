<?php

namespace App\Http\Controllers;

use App\Mail\new_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    public static function new_account_notify($email,$name){
        $data = [
            'email'=>$email,
            'name'=>$name
        ];

        Mail::to($email)->send(new new_account($data));
    }

}
