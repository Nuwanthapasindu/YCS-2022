<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\sectionClasses;
use App\Models\User;
use App\Models\UserClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class SectionController extends Controller
{
    public function add(Request $request){
        $rules = [
            'name'=>'required|string|unique:sections',
            'year'=>'numeric|unique:section_classes',
            'full_name'=>'required|string',
            'password' =>'required|min:8',
            'email' =>'required|email|unique:users'
        ];
//        Validating
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>$validator->errors()],400);
        endif;

        //        Creating Section



//      Creating User



//        Creating Section Admin Class


    }

    public function assign(User $uid){

    }
}
