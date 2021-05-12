<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'author_description' => $this->faker->text,
            'description' => $this->faker->text,
            'image' => "initialImage/first.png",
            'slug'=>Str::slug($this->faker->name),
            'author_id'=>1,
           
        ];
    }
}