<?php

namespace App\Http\Controllers;

use App\Models\attendence;
use App\Models\student;
use App\Models\sectionClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OtherAttendanceMarkController extends Controller
{
    /**
     * @param Request $request
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function  attendance(Request $request)
    {
        //        Validationg
        $validator = Validator::make($request->all(), [
            'uid' => 'required',
            'classId'=>'required'
        ]);
        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => 'Bad Request'], 400);
        endif;

        //        Fetch Student and Class Using params
        $student = student::where('uuid', $request->uid)->first();
        $studentClass =sectionClasses::where('uuid', $request->classId)->first('id');

        if ($student === null) :
            return response()->json(['status' => 400, 'message' => 'Invalid Student id'], 400);
        endif;

        $attendence_check = attendence::where([
            ['student_id', '=', $student->id],
            ['class_id', '=', $studentClass->id],
            ['date', '=', date('Y-m-d')],
        ])->first();

        /* Check whether student attendance is fully marked and update the field of attendance,
 true or false, if student attendance is marked*/

        if ($attendence_check === null) :
            $attendence = new attendence();
            $attendence->student_id = $student->id;
            $attendence->section_id =  Auth::user()->get_user_class->section_id;
            $attendence->class_id =  $studentClass->id;
            $attendence->teacher_id = Auth::user()->id;
            $attendence->date = date('Y-m-d');
            $attendence->time = Carbon::now('GMT+5:30');
            $attendence->attendance = true;
            $attendence->save();
            return response()->json(['status' => 201, 'message' => 'Attendance marked'], 201);
        else :

            if($attendence_check->attendance == false):
                $attendence_check->attendance = true;

            else:
                $attendence_check->attendance = false;

            endif;
            $attendence_check->update();
            return response()->json(['status' => 200, 'message' => 'Attendance Updated']);

        endif;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function todayAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'classId'=>'required'
        ]);
        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => 'Bad Request'], 400);
        endif;

        //        Fetch Student and Class Using params
        $studentClass =sectionClasses::where('uuid', $request->classId)->first('id');

        $attendence_check = attendence::where([

            ['class_id', '=',$studentClass->id ],
            ['date', '=', date('Y-m-d')],
        ])->orderby('id','desc')->get();
        foreach ($attendence_check as $item) {
            $item->student;
        }
        return response()->json(['status' => 200, 'attendance' => $attendence_check], 200);
    }
}
