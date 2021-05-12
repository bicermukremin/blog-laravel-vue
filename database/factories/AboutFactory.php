<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = About::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'images' => '["initialImage\/first.png","initialImage\/logo-construction.png","initialImage\/PmdesY.png","initialImage\/web-designing - Kopya.jpg"]',
            'mission' => $this->faker->text,
            'vision' => $this->faker->text,
            'history_content' => $this->faker->text,
            'history_items' => '[{"year":"2004","value":"Adipisci consequatur accusamus reprehenderit deserunt repellat ut inventore."},{"year":"2006","value":"Adipisci consequatur accusamus reprehenderit deserunt repellat ut inventore."},{"year":"2011","value":"Adipisci consequatur accusamus reprehenderit deserunt repellat ut inventore."}]',
            
            
        ];
    }
}