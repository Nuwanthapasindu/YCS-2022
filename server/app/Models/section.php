<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'section',
        'additional_data'
    ];
    public function sections (){
        return $this->hasMany(UserClasses::class,'section_id','id');
    }


}
