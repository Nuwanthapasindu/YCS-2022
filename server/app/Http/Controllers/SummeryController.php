<?php

namespace App\Http\Controllers;

use App\Models\attendence;
use App\Models\section;
use App\Models\sectionClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SummeryController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ClassWise(){

        $countArray = [];

        $classes = sectionClasses::where([
            'section_id'=>Auth::user()->get_user_class->section_id,
            ['class_name','!=','*']
        ])->get();
//Class wise Attendance
        foreach ($classes as $class){

        $attendance = attendence::where([
            'section_id'=>Auth::user()->get_user_class->section_id,
            'class_id'=>$class->id,
            'date'=>date('Y-m-d'),
            'attendance'=>true
        ])->count();


            $data = [
                'class'=>$class->class_name,
                'attendance'=>$attendance
            ];
        array_push($countArray,$data);

        }

// Section all classes Attendance

        $allSectionAttendance = attendence::where([
            'section_id'=>Auth::user()->get_user_class->section_id,
            'date'=>date('Y-m-d'),
            'attendance'=>true
        ])->count();
    return response()->json(['classWiseAttendance'=>$countArray,'allSectionAttendance'=>$allSectionAttendance]);
    }
    public function allSectionSummery(){
        $sectionsArray = [];

        $sections = section::where([
            ['section','!=','*']
        ])->get();
        foreach ($sections as $section){
            $attendance = attendence::where([
                'section_id'=>$section->id,
                'date'=>date('Y-m-d'),
                'attendance'=>true
            ])->count();
            $data = [
                'section'=>[
                    'name'=>$section->section,
                    'id'=>$section->id
                ],
                'attendance'=>$attendance
            ];
            array_push($sectionsArray,$data);
        }

        $allSectionAttendance = attendence::where([
            'date'=>date('Y-m-d'),
            'attendance'=>true
        ])->count();
    return response()->json([
        'sectionsWiseAttendance'=>$sectionsArray,

        'allSchoolAttendance'=>$allSectionAttendance
    ]);

    }
    public function selectedSectionAttendance($section)
    {
        $countArray = [];

        $classes = sectionClasses::where([
            'section_id'=>$section,
            ['class_name','!=','*']
        ])->get();
        //Class wise Attendance
        foreach ($classes as $class){

            $attendance = attendence::where([
                'section_id'=>$section,
                'class_id'=>$class->id,
                'date'=>date('Y-m-d'),
                'attendance'=>true
            ])->count();


            $data = [
                'class'=>$class->class_name,
                'attendance'=>$attendance
            ];
            array_push($countArray,$data);

        }

        return response()->json(['selectedSectionAttendance'=>$countArray]);
    }
}
