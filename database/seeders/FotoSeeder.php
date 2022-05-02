<?php

namespace Database\Seeders;

use App\Models\Foto;
use App\Models\Piso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Foto::factory(60)->create();
        $fotos = Foto::all('id');
        for ($i=0; $i < 25; $i++) { 
            Piso::factory(1)->create(['id_piso'=>$fotos[random_int(0,59)]]);
        }
    }
}
