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
            'images' => '["about\/G9x7PNNlOpjrRwGF8x3bssl54aP84xiuzlJCQWvt.png","about\/Txft6TMjnrgdzVhUOy6gUCdf46G7Tz6XhGwMf45v.jpg","about\/EHPX2mfJbFS5z9dhyyL4fuTrcJ46Mk3elpnSHbJI.jpg","about\/fAWvDYBq55qDbx5Bq6gk27zHcFE0UETs3ffk1FV0.jpg"]',
            'mission' => $this->faker->text,
            'vision' => $this->faker->text,
            'history_content' => $this->faker->text,
            'history_items' => '[{"year":"2004","value":"Adipisci consequatur accusamus reprehenderit deserunt repellat ut inventore."},{"year":"2006","value":"Adipisci consequatur accusamus reprehenderit deserunt repellat ut inventore."},{"year":"2011","value":"Adipisci consequatur accusamus reprehenderit deserunt repellat ut inventore."}]',
            
            
        ];
    }
}