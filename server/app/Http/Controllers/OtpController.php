<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpController extends Controller
{
    public static function otp(){
        return   rand(111111,999999) ;
    }
}
