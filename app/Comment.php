<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=['body',"user_id","question_id","url"];

    public static $rules =array(
        'body'        =>  'required',
        'user_id'     =>  'required|numeric',
        'question_id' =>  'required|numeric',
    );


    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
