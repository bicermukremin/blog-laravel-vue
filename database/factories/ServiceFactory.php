<?php

namespace Database\Factories;

use App\Models\Service;
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
       return [
            'title' => $this->faker->name,
            'slug' => $this->faker->name,
            'images' => '["service\/RM5PLm0LIAq2MmiNLFGzq0O3X1wYusy0G0er8nHT.png","service\/h3INKYdLQPcPFz5i0PNFvO7HP1MHdhjoazwmuqXB.png","service\/HB2fugUECp8dda0bqrgGZK5DlgmzyiaLNqRyCYPN.png","service\/KcBit6xhCVMb1ZnAlrDZPmpuHE5zcJ4BvkftoTwQ.png","service\/GXNUJjMGXVbIX1QsFPl2IlEgD9sTsOO6gVuhglpz.png","service\/wsuIuSWGpAn6FStq4DxbpDyBThiSoTYu5M3H7QTF.jpg","service\/6mRL4KKKUZVDQKdI10ICYN2vZZjhG35sZujN0xSI.jpg","service\/P00aWGRzNcStEwgooPHQXfK6aqAEVtEuJF5ElDur.jpg","service\/HjsteRGIDobSe9RaHgaAA5SbHdMPC61jnJselqly.jpg"]',
            'items' => '[{"value":"sadasdasdasdasd"},{"value":"asdasdsadsadasd"},{"value":"sdasadsadsadsads"}]',
            'content'=>$this->faker->sentence(5)
        ];
    }
}