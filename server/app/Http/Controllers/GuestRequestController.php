<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\User;
use Illuminate\Http\Request;

class GuestRequestController extends Controller
{
    /**
     * AllUsers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function AllUsers()
    {
        $users = User::where('role', '!=', 'admin')->get(['id', 'full_name', 'role']);
        return response()->json(['users' => $users], 200);
    }

    /**
     * AllSections
     * @return \Illuminate\Http\JsonResponse
     */
    public function AllSections()
    {
        $sections = section::where('section', '!=', '*')->orderBy('id', 'desc')->get();

        return response()->json(['status' => 200, 'sections' => $sections], 200);
    }
}
