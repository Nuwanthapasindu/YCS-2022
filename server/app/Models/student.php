<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $fillable=[
        'uuid',
        'admission_number',
        'full_name',
        'mobile_number',
        'address',
        'mother_name',
        'father_name'
    ];
    public function section(){
        return $this->hasOne(studentClass::class,'section_id','id');
    }
    public function class(){
        return $this->hasOne(studentClass::class,'class_id','id');
    }
    public function attendence(){
        return $this->hasMany(attendence::class,'student_id','id');
    }

}
