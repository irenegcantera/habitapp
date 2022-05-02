<?php

namespace Database\Factories;

use App\Models\Piso;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mensaje>
 */
class MensajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contenido'=> $this->faker->sentence(),
            'fecha_enviado'=> $this->faker->dateTime(),
            'fecha_recibido' => $this->faker->dateTime(),
            'from_user' => function(){
                return User::factory()->create()->id;
            },
            'to_user' => function(){
                return User::factory()->create()->id;
            },
            'piso_id' => function(){
                return Piso::factory()->create()->id;
            },

        ];
    }
}
