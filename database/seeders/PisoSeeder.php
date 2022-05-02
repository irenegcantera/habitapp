<?php

namespace Database\Seeders;

use App\Models\Piso;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Piso::factory(30)->create();
        // $pisos = Piso::all('id');
        // for ($i = 0; $i < 30; $i++){
        //     User::factory(1)->create(['user_id'=>$pisos[random_int(0,29)]]);
        // }
    }
}
