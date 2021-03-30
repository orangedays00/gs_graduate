<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberReview extends Model
{
    //
    public function user()
    {
        // return $this->belongsTo(\App\User::class, 'user_id', 'id')
        //     ->select('id', 'name');
        return $this->belongsTo('App\User');
        // return $this->belongsToMany('App\User');
    }
}
