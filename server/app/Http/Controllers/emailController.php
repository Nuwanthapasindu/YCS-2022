<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\Mail\Account_verification;
use App\Mail\new_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    /**
     * @param $email
     * @param $name
     * @param $password
     * @param $role
     * @return void
     */
    public static function new_account_notify($email, $name, $password, $role)
    {
        $data = [
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'role' => $role,
        ];

        Mail::to($email)->send(new new_account($data));
    }

    /**
     * @param $email
     * @param $otp
     * @return void
     */

    public static function account_verification($email, $token)
    {
        $data = [
            'email' => $email,
            'token' => $token
        ];

        Mail::to($email)->send(new Account_verification($data));
    }
}
