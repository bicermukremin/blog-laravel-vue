<?php

namespace Database\Factories;

use App\Models\Email;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ad_soyad' => $this->faker->name,
            'email' => $this->faker->email,
            'from' => 'bicermukremin86@gmail.com',
            'content' => $this->faker->text,
            'konu' => $this->faker->sentence(1),
            'type' =>'contact',
        ];
    }
}