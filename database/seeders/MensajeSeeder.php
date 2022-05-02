<?php

namespace Database\Seeders;

use App\Models\Mensaje;
use App\Models\Piso;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MensajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mensaje::factory(10)->create();
        $users = User::all('id');
        $pisos = Piso::all('id');
        for ($i=0; $i < count($users); $i++) { 
            User::factory(1)->create(['from_user'=>$users[random_int(0,count($users)-1)]]);
            User::factory(1)->create(['to_user'=>$users[random_int(0,count($users)-1)]]);
            Piso::factory(1)->create(['piso_id'=>$pisos[random_int(0,count($pisos)-1)]]);
        }
    }
}
