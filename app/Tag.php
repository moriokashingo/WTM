<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tags';
    protected $fillable=['name'];
    public function questions()
    {
        // return $this->belongsToMany('App\Question');
        return $this->belongsToMany('App\Question');
    }
}
