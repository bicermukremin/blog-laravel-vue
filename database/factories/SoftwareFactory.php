<?php

namespace Database\Factories;

use App\Models\Software;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoftwareFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Software::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'images' => '["initialImage\/first.png","initialImage\/logo-construction.png",initialImage\/first.png","initialImage\/PmdesY.png","initialImage\/web-designing - Kopya.jpg,initialImage\/first.png"]',
        ];
    }
}