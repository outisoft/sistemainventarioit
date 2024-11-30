<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complement>
 */
class ComplementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => rand(1, 11),
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'serial' => $this->faker->word,
            'region_id' => rand(1, 4),
            // Otros campos si los tienes
        ];
    }
}
