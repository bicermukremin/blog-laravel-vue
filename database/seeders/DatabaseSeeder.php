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
        \App\Models\Slider::create([
            'title'=>'Web Design',
            'image'=>'frontend/img/demos/construction/slides/slide-construction-1.jpg'
        ]);
        \App\Models\Slider::create([
            'title'=>'Modern Web Site',
            'image'=>'frontend/img/demos/construction/slides/slide-construction-2.jpg'
        ]);
    }
}
