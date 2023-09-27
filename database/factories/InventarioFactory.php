<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word, // Puedes personalizar este campo según tus necesidades
            'cantidad' => $this->faker->randomNumber(2), // Genera un número aleatorio de hasta 2 dígitos
            'precio' => $this->faker->randomFloat(2, 1, 1000), // Genera un número decimal aleatorio con 2 decimales
        ];
    }
}
