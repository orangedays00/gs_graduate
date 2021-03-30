<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    
    protected $fillable = [
        'user_id',
        'title',
        'body',
        ];
        
    public function post_user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
