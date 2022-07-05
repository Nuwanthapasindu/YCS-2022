<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClasses extends Model
{
    use HasFactory;


    protected $fillable =[
        'user_id',
        'section_id',
        'class_id'
];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function section(){
        return $this->belongsTo(section::class,'section_id','id');
    }
    public function get_class(){
        return $this->belongsTo(sectionClasses::class,'class_id','id');
    }
}
