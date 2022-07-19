<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendence extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'section_id',
        'class_id',
        'date',
        'time',
        'teacher_id',
        'attendance'
    ];
    protected $casts = [
        'attendance'=>'boolean'
    ];

    public function student(){
        return $this->belongsTo(student::class,'student_id','id');
    }
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id','id');
    }
    public function section(){
        return $this->belongsTo(section::class,'section_id','id');
    }
    public function student_class(){
        return $this->belongsTo(studentClass::class,'class_id','id');
    }
}
