<?php

namespace Database\Factories;
use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_id' => rand(1,12),
            'no_equipo' => $this->faker->unique()->numberBetween(1, 100),
            'marca' => $this->faker->word,
            'modelo' => $this->faker->word,
            'serie' => $this->faker->word,
            'ip' => $this->faker->ipv4,
            // Otros campos si los tienes
        ];
    }
}
