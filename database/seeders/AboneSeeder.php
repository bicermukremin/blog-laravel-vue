<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AboneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\Abone::factory(3)->create();
    }
}