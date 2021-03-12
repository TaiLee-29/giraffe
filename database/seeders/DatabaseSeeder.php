<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $users =\App\Models\User::factory(10)->create();
         $post = \App\Models\Post::factory(100)->make(['user_id' => null])->each(function ($post) use($users){
             $post->user_id = $users->random()->id;
             $post->save();

         });


    }
}
