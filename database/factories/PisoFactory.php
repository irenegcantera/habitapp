<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Piso>
 */
class PisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'longitud'=> $this->faker->randomFloat(8,36,45),
            'latitud'=> $this->faker->randomFloat(8,-10,4),
            'titulo'=> $this->faker->sentence(),
            'calle' => $this->faker->sentence(),
            'cod_postal' => $this->faker->numerify('#####'),
            'descripcion' => $this->faker->paragraph(true),
            'num_habitaciones' => $this->faker->numberBetween(1,6),
            'num_aseos' => $this->faker->numberBetween(1,3),
            'm2' => $this->faker->numberBetween(30,300),
            'precio' => $this->faker->numberBetween(150,1000),
            'user_id' => function(){
                return User::factory()->create()->id;
            },
        ];
    }
}
