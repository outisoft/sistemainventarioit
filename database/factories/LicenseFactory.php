<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LicenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typeIds = [11, 15, 17, 18];
        return [
            'type_id' => $typeIds[array_rand($typeIds)],
            'type' => $this->faker->word,
            'key' => $this->faker->word,
            'end_date' => $this->faker->dateTimeBetween('-1 day', '+1 year'),
            'max' => 1,
            'region_id' => 1,
        ];
    }
}
