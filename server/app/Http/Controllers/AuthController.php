<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $rules=[
            'email'=>'required|email',
            'password'=>'required|string|min:8',
        ];
    // Validating Request
    $validator =Validator::make($request->all(),$rules);
    if ($validator->fails()):
        return response()->json(['status'=>400,'message'=>$validator->errors()],400);
    endif;

//    Check the user
    if (!Auth::attempt($request->only(['email','password']))):
    return response()->json(['status'=>401,'message'=>'Unauthorized'],401);
    else:

//         Check Account Activation
     if (Auth::user()->status == true ):
//        Passs the Access token
             $token = Auth::user()->createToken('Auth Token')->accessToken;
            return response()->json(['status'=>200,'token'=>$token],200);
            else:
            return response()->json(['status'=>401,'message'=>'Your account has been blocked'],401);
             endif;
    endif;

    }


    /**
     * Authenticated User
     * @return \Illuminate\Http\JsonResponse
     */
    public function Auth_user(){
        $user =Auth::user();
        $user->get_class;
        return response()->json(['status'=>200,'user'=>$user]);
    }

    /**
     * Logout
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
    $token = $request->user()->token();
    $token->revoke();
    return response()->json(['status'=>200,'message'=>'Logout'],200);
    }
}
