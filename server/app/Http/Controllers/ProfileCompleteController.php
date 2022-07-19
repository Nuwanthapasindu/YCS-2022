<?php

namespace App\Http\Controllers;

use App\helpers\FileHandler;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileCompleteController extends Controller
{
    /**
     * complete
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */

    public function complete(Request $request,$uuid )
    {
        $rules = [
            'Full_name'=> 'required',
            'mobile_number'=> 'required|min:9|max:11',
            'Address'=> 'required',
            'password'=> 'required|min:8',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>$validator->errors()],400);
        endif;
        $user = User::where(['uuid'=>$uuid])->first();
        $user->full_name = $request->input('Full_name') ;
        $user->mobile_number = $request->input('Mobile_number') ;
        $user->address = $request->input('Address') ;
        $user->password = Hash::make($request->input('password')) ;
        $user->completed = true;
        $user->update();
        return response()->json(['status'=>201,'message'=>'Account updated successfully.'],201);
    }

    /**
     * profile_pic
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function profile_pic(Request $request,$uuid )
    {
        $validator = Validator::make($request->all(),[
            'profile_pic'=>'required|mimes:jpg,png'
        ]);
        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>$validator->errors()],400);
        endif;
        if($request->hasFile('profile_pic')):
            $user = User::where(['uuid'=>$uuid])->first();
            $uploaded = Storage::disk('public')->put('profilePictures',$request->file('profile_pic'));
            $path = env('APP_URL').'storage/'.$uploaded;
            if($user->profile_pic == null):
                $user->profile_pic = $path;
                $user->update();
            else:
                $explode = explode('/',$user->profile_pic);
                FileHandler::Delete('public/'.$explode[4].'/'.$explode[5]);
                $user->profile_pic = $path;
                $user->update();

            endif;
            return response()->json(['status'=>201,'path'=>$path],201);
        endif;
    }
}
