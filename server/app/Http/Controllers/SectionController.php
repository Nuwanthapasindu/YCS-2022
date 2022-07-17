<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\helpers\LatestRecordHelper;
use App\Models\section;
use App\Models\sectionClasses;
use App\Models\User;
use App\Models\UserClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class SectionController extends Controller
{

    public function __construct()
    {

        if (auth()->guard('api')->user() === null ||
            auth()->guard('api')->user()->status === false ||
            auth()->guard('api')->user()->completed === false ||
            auth()->guard('api')->user()->role->name !== roles::ADMIN->name):
         dd('You do not have permission to access this secured area');
        endif;
    }

    /**
     * ADD
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function add(Request $request){
        $rules = [
            'section'=>'required|string|unique:sections',
            'year'=>'numeric',
            'Section_head_name'=>'required|string',
            'password' =>'required|min:8',
            'email' =>'required|email|unique:users'
        ];

//        Validating
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>$validator->errors()],400);
        endif;

        //        Creating Section
        $section_uuid = Uuid::generate()->string;
        $section = new section();
        $section->uuid =$section_uuid;
        $section->section =$request->section;
        $section->additional_data =$request->other_details;
        if(!$section->save()):
            return response()->json(['message'=>'There was an error creating a school Section on our system'],400);
           else:
            $section_id =  LatestRecordHelper::latest_section();
            endif;

//      Creating User
        $user_uuid = Uuid::generate()->string;
        $user = new User();
        $user->uuid = $user_uuid;
        $user->email = $request->email;
        $user->profile_pic = 'http://localhost:8000/storage/profilePictures/user.jpg';
        $user->full_name = $request->Section_head_name;
        $user->password = Hash::make($request->password);
        $user->role = roles::SECTION_HEAD;
        $user->status = true;

        if(!$user->save()):
            return response()->json(['message'=>'There was an error creating a user on our system'],400);
        else:
            $user_id =  LatestRecordHelper::latest_user();
        endif;

//        Creating Section Admin Class
        $class_uuid = Uuid::generate()->string;
        $section_class = new  sectionClasses();
        $section_class->uuid=$class_uuid;
        $section_class->section_id=$section_id;
        $section_class->class_name='*';
        $section_class->other= 'SECTION HEAD CLASS';
        if ($request->year !== null):
        $section_class->year= $request->year;
        else:
        $section_class->year=date('Y');
            endif;
        if(!$section_class->save()):
            return response()->json(['message'=>'There was an error creating a section head class on our system'],400);
        else:
            $class_id =  LatestRecordHelper::latest_class();
        endif;

//        Assign to user class
        $user_class = new UserClasses();
        $user_class->user_id = $user_id;
        $user_class->section_id = $section_id;
        $user_class->class_id = $class_id;
        $user_class->save();

        emailController::new_account_notify($request->email,$request->full_name,$request->password,roles::SECTION_HEAD->value);
        return response()->json(['status'=>201,'Message'=> 'Successfully Created'],201);


    }

    /**
     * ALL
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(){
        $sections = section::where('id','!=','1')->orderBy('id','desc')->get();

        return response()->json(['status'=>200,'sections'=>$sections],200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sectionData($id){
        $sections = UserClasses::where('section_id',$id,)->get();
        foreach ($sections as $section):
            $section->get_user;
            $section->get_class;
//            $section->section;
            endforeach;
        return response()->json(['status'=>200,'Section_classes'=>$sections],200);
    }


}
