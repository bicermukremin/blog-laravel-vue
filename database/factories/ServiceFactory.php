<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title=$this->faker->name;
       return [
            'title' => $title,
            'slug' => Str::slug($title),
            'images' => '["initialImage\/first.png","initialImage\/logo-construction.png","initialImage\/PmdesY.png","initialImage\/web-designing - Kopya.jpg"]',
            'items' => '[{"value":"sadasdasdasdasd"},{"value":"asdasdsadsadasd"},{"value":"sdasadsadsadsads"}]',
            'content'=>$this->faker->sentence(5)
        ];
    }
}