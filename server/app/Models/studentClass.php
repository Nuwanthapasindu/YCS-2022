<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentClass extends Model
{
    use HasFactory;
    protected $fillable=[
        'uuid',
        'student_id',
        'section_id',
        'class_id'
    ];
    public function student(){
        return $this->belongsTo(student::class,'student_id','uuid');
    }
    public function section(){
        return $this->belongsTo(section::class,'section_id','uuid');
    }
    public function student_class(){
        return $this->belongsTo(studentClass::class,'class_id','uuid');
    }
}
