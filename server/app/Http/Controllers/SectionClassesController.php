<?php

namespace App\Http\Controllers;

use App\Models\sectionClasses;
use Illuminate\Http\Request;

class SectionClassesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function all(){
        $classes = sectionClasses::where('class_name','!=','*')->get();
        return response()->json(['status'=>200,'classes'=>$classes],200);
    }
}
