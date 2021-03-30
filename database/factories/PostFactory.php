<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->realText(50),
        'body' => $faker->realText(800),
        'user_id' => function(){
            return User::all()->random();
        }
    ];
});
