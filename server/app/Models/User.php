<?php

namespace App\Models;

use App\enum\roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'profile_pic',
        'full_name',
        'mobile_number',
        'address',
        'email',
        'password',
        'role',
        'status'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role'=>roles::class,
    ];
    public function get_section(){
        return $this->hasOne(sectionClasses::class,'section_id','id');
    }
    public function get_user_class(){
        return $this->hasOne(UserClasses::class,'user_id','id');
    }
}
