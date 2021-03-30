<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use App\User;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        //
        'comment' => $faker->realText(400),
        'user_id' => function(){
            return User::all()->random();
        }
    ];
});
