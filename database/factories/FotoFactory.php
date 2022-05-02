<?php

namespace Database\Factories;

use App\Models\Piso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Foto>
 */
class FotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=> $this->faker->sentence(),
            'piso_id' => function(){
                return Piso::factory()->create()->id;
            },
        ];
    }
}
