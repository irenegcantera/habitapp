<?php

namespace Database\Seeders;

use App\Models\UserRentPiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRentPisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRentPiso::factory(10)->create();
    }
}
