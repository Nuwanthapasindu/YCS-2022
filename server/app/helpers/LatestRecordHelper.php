<?php

namespace App\helpers;

use App\Models\section;
use App\Models\sectionClasses;
use App\Models\User;

class LatestRecordHelper
{
    public static function latest_section()
    {
        $section = section::latest()->first('id');

        return $section->id;
    }
    public static function latest_user()
    {
        $user = User::latest()->first('id');

        return $user->id;
    }
    public static function latest_class()
    {
        $section_classes = sectionClasses::latest()->first('id');

        return $section_classes->id;
    }
}
