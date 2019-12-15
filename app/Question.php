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



    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
