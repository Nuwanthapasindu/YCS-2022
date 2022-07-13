<?php

namespace App\Http\Controllers;

use App\helpers\FileHandler;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
    return response()->json(['status'=>401,'message'=>'Invalid Credentials'],401);
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
       if ($user->status == true):
           $user->get_user_class->get_class;
           return response()->json(['status'=>200,'user'=>$user]);
       else:
           return response()->json(['status'=>401,'message'=>'Your account has been blocked'],401);
           endif;
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

    /**
     * profile
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request,$uuid )
    {
        $rules=[
            'Full_name'=>'required',
            'mobile_number'=>'required|min:9|max:11',
            'Address'=>'required',
            'email'=>'required|email',
        ];
        // Validating Request
        $validator =Validator::make($request->all(),$rules);
        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>$validator->errors()],400);
        endif;

        $user = User::where(['uuid'=>$uuid])->first();
        if ( $user->full_name !== $request->input('Full_name')):
        $user->full_name = $request->input('Full_name');
        endif;
        if ($user->mobile_number !==$request->input('mobile_number')):
        $user->mobile_number = $request->input('mobile_number');
        endif;
        if ($user->address !==$request->input('Address')):
        $user->address = $request->input('Address');
        endif;
        if ($user->email !==  $request->input('email')):
        $user->email = $request->input('email');
        endif;
        $user->update();

        return response()->json(['status'=>201,'message'=>'Account updated successfully.'],201);
    }

    /**
     * Passwor dUpdate
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function PasswordUpdate(Request $request,$uuid )
    {
        $rules=[
            'password'=>'required|min:8',
        ];
        // Validating Request
        $validator =Validator::make($request->all(),$rules);

        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>$validator->errors()],400);
        endif;

        $user = User::where(['uuid'=>$uuid])->first();
        $user->password =Hash::make( $request->input('password'));
        $user->update();

        return response()->json(['status'=>201,'message'=>'Password updated successfully.'],201);
    }

}
