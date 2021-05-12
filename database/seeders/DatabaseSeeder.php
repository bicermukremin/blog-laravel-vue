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
     \App\Models\User::factory(10)->create();
     \App\Models\Slider::factory(3)->create();
     \App\Models\Service::factory(4)->create();
     \App\Models\About::factory(1)->create();
     \App\Models\Category::factory(5)->create();
     \App\Models\Blog::factory(5)->create();
     \App\Models\Comment::factory(5)->create();
     \App\Models\Project::factory(7)->create();
     \App\Models\Reply::factory(7)->create();
     \App\Models\Software::factory(1)->create();
      \App\Models\Email::factory(2)->create();
      \App\Models\Setting::factory(1)->create();
      \App\Models\Banner::factory(3)->create();
      \App\Models\Abone::factory(3)->create();
      \App\Models\Profile::factory(10)->create();

     

    }
}