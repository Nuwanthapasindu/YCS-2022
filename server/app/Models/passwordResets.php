<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passwordResets extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'token',
    ];


    public function passwordResetsUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
