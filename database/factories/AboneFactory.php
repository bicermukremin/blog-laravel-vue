<?php

namespace Database\Factories;

use App\Models\Abone;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Abone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'email' => $this->faker->email,
           
        ];
    }
}