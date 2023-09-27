<?php

namespace Database\Factories;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition()
    {
        return [
            'no_empleado' => $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'puesto' => $this->faker->jobTitle,
            'departamento' => $this->faker->word,
            'hotel_id' => rand(1,4),
            'ad' => $this->faker->userName,
        ];
    }
}
