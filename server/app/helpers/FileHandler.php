<?php
namespace App\helpers;
use Illuminate\Support\Facades\Storage;

class FileHandler{
    public static function Delete($path){
        if (Storage::exists($path)):
            Storage::delete($path);
        endif;
    }
}
