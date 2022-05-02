<?php

namespace Database\Factories;

use App\Models\Piso;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRentPiso>
 */
class UserRentPisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                return User::factory()->create()->id;
            },
            'piso_id' => function(){
                return Piso::factory()->create()->id;
            },
            'fecha_inicio'=> $this->faker->dateTime(),
            'fecha_fin' => $this->faker->dateTime(),

        ];
    }
}
