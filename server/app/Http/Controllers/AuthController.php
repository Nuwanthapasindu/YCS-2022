<?php

namespace App\Http\Controllers;

use App\helpers\FileHandler;
use App\Models\passwordResets;
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
    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
        // Validating Request
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        endif;

        //    Check the user
        if (!Auth::attempt($request->only(['email', 'password']))) :
            return response()->json(['status' => 401, 'message' => 'Invalid Credentials'], 401);
        else :

            //         Check Account Activation
            if (Auth::user()->status == true) :
                //        Passs the Access token
                $token = Auth::user()->createToken('Auth Token')->accessToken;
                return response()->json(['status' => 200, 'token' => $token], 200);

            else :
                return response()->json(['status' => 401, 'message' => 'Your account has been blocked'], 401);
            endif;
        endif;
    }


    /**
     * Authenticated User
     * @return \Illuminate\Http\JsonResponse
     */
    public function Auth_user()
    {
        $user = Auth::user();
        if ($user->status == true) :
            $user->get_user_class->get_class;
            return response()->json(['status' => 200, 'user' => $user]);
        else :
            return response()->json(['status' => 401, 'message' => 'Your account has been blocked'], 401);
        endif;
    }

    /**
     * Logout
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json(['status' => 200, 'message' => 'Logout'], 200);
    }

    /**
     * profile
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request, $uuid)
    {
        $rules = [
            'Full_name' => 'required',
            'mobile_number' => 'required|min:9|max:11',
            'Address' => 'required',
            'email' => 'required|email',
        ];
        // Validating Request
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        endif;

        $user = User::where(['uuid' => $uuid])->first();
        if ($user->full_name !== $request->input('Full_name')) :
            $user->full_name = $request->input('Full_name');
        endif;
        if ($user->mobile_number !== $request->input('mobile_number')) :
            $user->mobile_number = $request->input('mobile_number');
        endif;
        if ($user->address !== $request->input('Address')) :
            $user->address = $request->input('Address');
        endif;
        if ($user->email !==  $request->input('email')) :
            $user->email = $request->input('email');
        endif;
        $user->update();

        return response()->json(['status' => 201, 'message' => 'Account updated successfully.'], 201);
    }

    /**
     * Password dUpdate
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function PasswordUpdate(Request $request, $uuid)
    {
        $rules = [
            'password' => 'required|min:8',
        ];
        // Validating Request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        endif;

        $user = User::where(['uuid' => $uuid])->first();
        $user->password = Hash::make($request->input('password'));
        $user->update();

        return response()->json(['status' => 201, 'message' => 'Password updated successfully.'], 201);
    }

    /**
     * emailVerification
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function emailVerification(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
        ];
        // Validating Request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        endif;

        // Getting the user using email
        $user = User::where('email', $request->email)->first();
        if (empty($user)) :
            return response()->json(['status' => 400, 'message' => 'Invalid email address.'], 400);
        endif;
        $token = $user->createToken('Auth Token')->accessToken;

        // Saving the User id,email and token in password resets table
        $passwordReset = new passwordResets();
        $passwordReset->user_id = $user->id;
        $passwordReset->email = $user->email;
        $passwordReset->token = $token;
        $passwordReset->save();


        emailController::account_verification($request->email, $token);
        return response()->json(['status' => 201, 'message' => 'Email Verification mail send successfully.Please check Your Email'], 200);
    }

    /**
     * ForgotPasswordUpdate
     *
     * @param  mixed $request
     * @param  mixed $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function ForgotPasswordUpdate(Request $request, $token)
    {

        $rules = [
            'password' => 'required|min:8',
        ];
        // Validating Request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        endif;


        // Getting the user Details using token
        $tokenUser = passwordResets::where('token', $token)->first()->passwordResetsUser;

        if (empty($tokenUser)) {

            return response()->json(['status' => 400, 'message' => 'Invalid token.'], 400);
        }


        $tokenUser->password = Hash::make($request->input('password'));
        $tokenUser->update();
        $tokenUser = passwordResets::where('token', $token)->first();
        $tokenUser->delete();


        return response()->json(['status' => 201, 'message' => 'Password updated successfully.'], 201);
    }
}
