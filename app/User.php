<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','thumbnail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function questions(){
        return $this->hasMany(\App\Question::class,'user_id','id');
    }
    public function comments(){
        return $this->hasMany(\App\Comment::class,'user_id','id');
    }
    public static $editRules = array(
        'password' => 'confirmed',
        'user_id'  => 'integer|required',
        'name'     => 'required',
        'thumbnail'=>'file|image|mimes:jpeg,png,jpg,gif|max:2048',
    );
}
