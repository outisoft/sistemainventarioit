<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tpv>
 */
class TpvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area' => $this->faker->word,
            'hotel_id' => rand(1, 9),
            'equipment' => $this->faker->word,
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'no_serial' => $this->faker->word,
            'name' => $this->faker->name,
            'ip' => $this->faker->ipv4,
            'link' => $this->faker->word,
        ];
    }
}
