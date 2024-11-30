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
            'tipo_id' => rand(1, 11),
            'marca' => $this->faker->word,
            'model' => $this->faker->word,
            'serial' => $this->faker->word,
            'name' => $this->faker->word,
            'ip' => $this->faker->ipv4,
            'so' => $this->faker->word,
            'policy_id' => rand(1, 12),
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->word,
            'no_contrato' => $this->faker->word,
            'orden' => $this->faker->word,
            'region_id' => rand(1, 4),
            // Otros campos si los tienes
        ];
    }
}
