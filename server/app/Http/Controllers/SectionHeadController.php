<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\helpers\LatestRecordHelper;
use App\Models\sectionClasses;
use App\Models\User;
use App\Models\UserClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class SectionHeadController extends Controller
{
    /**
     * Constructor
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if (
            auth()->guard('api')->user() === null ||
            auth()->guard('api')->user()->status === false ||
            auth()->guard('api')->user()->completed === false ||
            auth()->guard('api')->user()->role->name !== roles::SECTION_HEAD->name
        ) :
            dd('You do not have permission to access this secured area');
        endif;
    }

    /**
     * ADD
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function add(Request $request)
    {

        $rules = [
            'teacher_name' => 'required|string',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'class_name' => 'required|string|unique:section_classes',
            'year' => 'numeric'
        ];
        //        Validating
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        endif;

        //      Creating User
        $user_uuid = Uuid::generate()->string;
        $user = new User();
        $user->uuid = $user_uuid;
        $user->email = $request->email;
        $user->profile_pic = null;
        $user->full_name = $request->teacher_name;
        $user->password = Hash::make($request->password);
        $user->role = roles::TEACHER;
        $user->status = true;

        if (!$user->save()) :
            return response()->json(['message' => 'There was an error creating a user on our system'], 400);
        else :
            $user_id =  LatestRecordHelper::latest_user();
        endif;

        //        Creating Section  Class
        $class_uuid = Uuid::generate()->string;
        $section_class = new  sectionClasses();
        $section_class->uuid = $class_uuid;
        $section_class->section_id = Auth::user()->get_user_class->section_id;
        $section_class->class_name = $request->class_name;
        $section_class->year = Auth::user()->get_user_class->get_class->year;
        if ($request->other !== null) :
            $section_class->other = $request->other;
        endif;

        if (!$section_class->save()) :
            return response()->json(['message' => 'There was an error creating a Class Teacher class on our system'], 400);
        else :
            $class_id =  LatestRecordHelper::latest_class();
        endif;

        //        Assign to user class
        $user_class = new UserClasses();
        $user_class->user_id = $user_id;
        $user_class->section_id = Auth::user()->get_user_class->section_id;
        $user_class->class_id = $class_id;
        $user_class->save();
        // emailController::new_account_notify($request->email, $request->full_name, $request->password, roles::TEACHER->value);
        return response()->json(['status' => 201, 'Message' => 'Successfully Created'], 201);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {

        $classes = sectionClasses::where([
            ['section_id', '=', Auth::user()->get_user_class->section_id],
            ['class_name', '!=', '*'],
            ['year', '=', Auth::user()->get_user_class->get_class->year]
        ])->get();
        return response()->json(['status' => 200, 'classes' => $classes], 200);
    }


    /**
     * classData
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function classData($id)
    {
        $rulles = [
            'section_id' => Auth::user()->get_user_class->section_id,
            'class_id' => $id,
        ];
        $sections = UserClasses::where($rulles)->orderBy('id', 'DESC')->get();
        foreach ($sections as $section) :
            $section->get_user;
            $section->get_class;
        //            $section->section;
        endforeach;
        return response()->json(['status' => 200, 'Section_classes' => $sections], 200);
    }

    /**
     * @param User $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function block(User $id)
    {

        $id->status = false;
        $id->update();
        return response()->json(['status' => 'Blocked'], 200);
    }

    /**
     * @param User $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unblock(User $id)
    {
        //        $user = User::where('uuid','=',$id)->first();
        $id->status = true;
        $id->update();
        return response()->json(['status' => 'UnBlocked'], 200);
    }
}
