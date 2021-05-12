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
            
            'images' => '["software\/BJBVVpgZDSAoHAIfdxuhZ6FkpDXKPvG44LNS3pxh.png","software\/gwetwYsbX2dtyGeCKEDw1jLhvYmqPIhiXeerEBDS.png","software\/oDPuRdtVqL6UtfxTC3cgXSQPFfR9trHjgdk9AbQp.jpg","software\/xdFqtX7Jc75YvMAKkz4645NYv4rbrtJY6C6X9ZPE.jpg","software\/K5BEds5n0yWG5fn1y1tyiUcQnNU26NMQyezj6nS5.jpg","software\/F2WMdvfWoqZKuGPkYPCidixdYObfKcHN1oaC6o3N.jpg"]',
        ];
    }
}