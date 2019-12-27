<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded= array('id');
    public static $rules =array(
        'description' =>  'required',
        'user_id'     =>  'required|numeric',
        'resolution'  =>  'boolean',
    );

    public $timestamps = true;


    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function tags()
    {
        // return $this->belongsToMany('App\Tag');
        return $this->belongsToMany('App\Tag'); // 追加
    }
}
