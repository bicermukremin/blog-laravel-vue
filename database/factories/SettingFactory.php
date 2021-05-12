<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'adres' => $this->faker->address,
            'map' => 'https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d1412.611336972185!2d33.78093964806234!3d41.39105030810868!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2str!4v1619976965700!5m2!1str!2str',
            'tel' => '5300000000',
            'email' => $this->faker->email,
            'logo1' => "initialImage/logo-construction.png",
            'logo2' => "initialImage/logo-construction-small.png",
            'facebook' => "https://www.facebook.com/mukremin.bicer.77",
            'twitter' => "https://www.twitter.com/bicer_mukremin",
            'instagram' => "https://www.instagram.com/mukobar/",
            'linkedin' => "https://www.linkedin.com/in/mükremin-b-1456b1188/",
            'github' => "https://github.com/bicermukremin",
            
        ];
    }
}