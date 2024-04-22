<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tablet>
 */
class TabletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'operario' => $this->faker->word,
            'puesto' => $this->faker->word,
            'email' => $this->faker->word,
            'usuario' => $this->faker->word,
            'password' => $this->faker->word,
            'numero_tableta' => $this->faker->word,
            'serial' => $this->faker->word,
            'numero_telefono' => $this->faker->word,
            'imei' => $this->faker->word,
            'sim' => $this->faker->word,
            'politica' => $this->faker->word,
            'configurada' => rand(1, 2),
            'carta_firmada' => rand(1, 2),
            'observacion' => $this->faker->word,
            'giacode' => $this->faker->word,
            'personalsdscode' => $this->faker->word,
            'folio_baja' => $this->faker->word,
            // Otros campos si los tienes
        ];
    }
}
