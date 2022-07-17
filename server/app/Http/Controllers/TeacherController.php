<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\helpers\LatestRecordHelper;
use App\Models\attendence;
use App\Models\sectionClasses;
use App\Models\student;
use App\Models\studentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class TeacherController extends Controller
{

    /**
     * __construct
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function __construct(Request $request)
    {
           if (auth()->guard('api')->user() === null ||
               auth()->guard('api')->user()->status === false ||
               auth()->guard('api')->user()->completed === false ||
               auth()->guard('api')->user()->role->name !== roles::TEACHER->name):
            dd('You do not have permission to access this secured area');
        endif;
    }

    /**
     *  Create Student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function  add(Request $request){

        $rules = [
            'admission_number'=>'required|unique:students|numeric',
            'full_name'=>'required|string|unique:students',
            'mobile_number'=>'required|string|unique:students|min:9',
            'address'=>'required|string',
            'mother_name'=>'required|string',
            'father_name'=>'required|string'
        ];
//        Validating
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>$validator->errors()],400);
            endif;

        //      Creating User
            $student = new student();
        $student->uuid =Uuid::generate()->string;
        $student->admission_number = $request->admission_number;
        $student->full_name = $request->full_name;
        $student->mobile_number = $request->mobile_number;
        $student->address = $request->address;
        $student->mother_name = $request->mother_name;
        $student->father_name = $request->father_name;
        if (!$student->save()):
            return response()->json(['message'=>'There was an error creating a student on our system'],400);
            else:
           $latest_student =  LatestRecordHelper::latest_student();
            endif;

        //        Assign Student to class
       $std_class = new studentClass();
        $std_class->uuid = Uuid::generate()->string;
        $std_class->student_id = $latest_student;
        $std_class->section_id = Auth::user()->get_user_class->section_id;
        $std_class->class_id = Auth::user()->get_user_class->class_id;
        $std_class->save();
        return response()->json(['status'=>201,'Message'=> 'Successfully Created'],201);
    }

    /**
     * Paginated Students
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(){
        $rules=[
            'section_id' => Auth::user()->get_user_class->section_id,
            'class_id' => Auth::user()->get_user_class->class_id,
        ];
        $students = studentClass::where($rules)->paginate(5);
        foreach ($students as $student):
        $student->student;
//        $student->section;
//        $student->student_class;
        endforeach;


        return response()->json(['status'=>200,'Students'=> $students],200);
    }

    /**
     * All Students
     * @return \Illuminate\Http\JsonResponse
     */
    public function allStudents(){
        $rules=[
            'section_id' => Auth::user()->get_user_class->section_id,
            'class_id' => Auth::user()->get_user_class->class_id,
        ];
        $students = studentClass::where($rules)->paginate(5);
        foreach ($students as $student):
        $student->student;
//        $student->section;
//        $student->student_class;
        endforeach;


        return response()->json(['status'=>200,'Students'=> $students],200);
    }

    /**
     * Edit
     * @param $uid
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function edit($uid){
        if (Uuid::validate($uid)):
        $student = student::where('uuid',$uid)->get();
        return response()->json(['status'=>200,'student'=>$student]);
        endif;
    }


    /**
     * Drop
     * @param $uid
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function drop($uid){
        if (Uuid::validate($uid)):
//            $student = student::where('uuid',$uid)->delete();
        DB::table('students')->where('uuid',$uid)->delete();
            return response()->json(['status'=>200,'message'=>'Deleted Successfully']);
        endif;
    }

    /**
     * Update
     * @param Request $request
     * @param $uid
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(Request $request, $uid){
        if (Uuid::validate($uid)):

            $rules = [
                'admission_number'=>'nullable|unique:students|numeric',
                'full_name'=>'nullable|string|unique:students',
                'mobile_number'=>'nullable|string|unique:students|min:9',
                'address'=>'nullable|string',
                'mother_name'=>'nullable|string',
                'father_name'=>'nullable|string'
            ];
//        Validating
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()):
                return response()->json(['status'=>400,'message'=>$validator->errors()],400);
            endif;
            $student = student::where('uuid',$uid)->first();
            if ($request->admission_number !== null):
                $student->admission_number = $request->admission_number;
                endif;
            if ($request->full_name !== null):
                $student->full_name = $request->full_name;
                endif;
            if ($request->mobile_number !== null):
                $student->mobile_number = $request->mobile_number;
                endif;
            if ($request->address !== null):
                $student->address = $request->address;
                endif;
            if ($request->mother_name !== null):
                $student->mother_name = $request->mother_name;
                endif;
            if ($request->father_name !== null):
                $student->father_name = $request->father_name;
                endif;
                $student->update();
            return response()->json(['status'=>200,'message'=>'Update Successfully']);
        endif;
    }

    /**
     * attendance
     * @param Request $request
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function  attendance(Request $request,$uid){
//        Validationg
        $validator = Validator::make($request->all(),[
            'attendance'=>'required|boolean'
        ]);
        if ($validator->fails()):
            return response()->json(['status'=>400,'message'=>'Bad Request'],400);
        endif;
//        Fetch Student Using uuid
        $student = student::where('uuid',$uid)->first();
        if ($student === null):

            return response()->json(['status'=>400,'message'=>'Invalid Student id'],400);
        endif;
        $attendence_check = attendence::where([
            ['student_id','=',$student->id],
            ['class_id','=',Auth::user()->get_user_class->class_id],
            ['date','=',date('Y-m-d')],
        ])->first();

/* Check whether student attendance is fully marked and update the field of attendance,
 true or false, if student attendance is marked*/

        if ($request->attendance == true && $attendence_check === null):
            $attendence = new attendence();
            $attendence->student_id =$student->id ;
            $attendence->section_id =  Auth::user()->get_user_class->section_id;
            $attendence->class_id =Auth::user()->get_user_class->class_id ;
            $attendence->date = date('Y-m-d');
            $attendence->time = Carbon::now('GMT+5:30');
            $attendence->attendance = true;
              $attendence->save();
            return response()->json(['status'=>201,'message'=>'Attendance marked'],201);
            else:
                $attendence_check->attendance = $request->attendance;
                $attendence_check->update();
            return response()->json(['status'=>200,'message'=>'Attendance Updated']);

        endif;


    }
}
