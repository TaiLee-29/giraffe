<?php

namespace Database\Seeders;

use App\Jobs\JobGeo;
use Faker\Factory;
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
        $faker = Factory::create();
         $users =\App\Models\User::factory(10)->create();
         $post = \App\Models\Post::factory(100)->make(['user_id' => null])->each(function ($post) use($users){
             $post->user_id = $users->random()->id;
             $post->save();

         });
        for ($i = 0; $i < 20; $i++) {
            JobGeo::dispatch($ip = $faker->ipv4, $userAgent = $faker->userAgent);
        }

    }


}
