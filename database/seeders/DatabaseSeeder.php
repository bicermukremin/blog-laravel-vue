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
     \App\Models\Service::create([
         'title'=>'Web Tasarım',
         'slug'=>'web-tasarım',
         'images'=>'frontend/img/demos/construction/slides/web-design-background_1300-39.jpg',
         'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.',
         'items'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.'
     ]);
 
     \App\Models\Service::create([
         'title'=>'SEO',
         'slug'=>'seo',
         'images'=>'frontend/img/demos/construction/slides/ivedik-web-tasarim-ajans.jpg',
         'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.',
         'items'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.'
     ]);
         \App\Models\Service::create([
         'title'=>'Web Yazılım',
         'slug'=>'web-yazılım',
         'images'=>'frontend/img/demos/construction/slides/ivedik-web-tasarim-ajans.jpg',
         'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.',
         'items'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.'
     ]);
     \App\Models\Service::create([
         'title'=>'E-Ticaret',
         'slug'=>'e-ticaret',
         'images'=>'frontend/img/demos/construction/slides/Blog_Best-Free-Tools.jpg',
         'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.',
         'items'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.'
     ]);
     \App\Models\Service::create([
         'title'=>'Wordpress',
         'slug'=>'wordpress',
         'images'=>'frontend/img/demos/construction/slides/Blog_Best-Free-Tools.jpg',
         'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.',
         'items'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.'
     ]);
     
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