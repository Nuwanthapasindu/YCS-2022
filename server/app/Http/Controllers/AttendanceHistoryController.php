<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\Models\attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceHistoryController extends Controller
{

    /**
     * __construct
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function __construct(Request $request)
    {
        if (
            auth()->guard('api')->user() === null ||
            auth()->guard('api')->user()->status === false ||
            auth()->guard('api')->user()->completed === false ||
            auth()->guard('api')->user()->role->name !== roles::TEACHER->name
        ) :
            dd('You do not have permission to access this secured area');
        endif;
    }

    public function getHistoryDate(Request $request){

$validator = Validator::make($request->all(),['attendanceDate'=>'required|string|date_format:Y-m-d']);

        if ($validator->fails()) :
            return response()->json(['status' => 400, 'message' => 'Bad Request'], 400);
        endif;
        $attendenceDatas = attendence::where([
            ['class_id', '=', Auth::user()->get_user_class->class_id],
            ['date', '=',date($request->attendanceDate)],
        ])->get();
        foreach ($attendenceDatas as $attendenceData) {
            $attendenceData->student;
            $attendenceData->teacher;
        }

//        return response()->json(['data'=>]);
        return response()->json(['data'=>$attendenceDatas]);
    }
}
