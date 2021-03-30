<?php

use Illuminate\Database\Seeder;
use App\Post; //追加
use App\Comment; //追加


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Post::class, 50)
        ->create()
        ->each(function ($post) {
            $comments = factory(App\Comment::class, 2)->make();
            $post->comments()->saveMany($comments);
        });
    }
}
