<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectionClasses extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'section_id',
        'class_name',
        'other',
        'year'
    ];
    public function section(){
        return $this->belongsTo(section::class,'section_id','uuid');
    }
}
