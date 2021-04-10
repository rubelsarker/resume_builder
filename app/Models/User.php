<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function social(){
        return $this->hasOne(Social::class,'user_id');
    }
    public function skills(){
        return $this->hasMany(Skill::class,'user_id');
    }
    public function projects(){
        return $this->hasMany(Project::class,'user_id');
    }
    public function personal(){
        return $this->hasOne(Personal::class,'user_id');
    }
    public function employments(){
        return $this->hasMany(Employment::class,'user_id');
    }
    public function educations(){
        return $this->hasMany(Education::class,'user_id');
    }
}
