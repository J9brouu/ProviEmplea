<?php

namespace Database\Factories;

use App\Models\Talento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Talento>
 */
class TalentoFactory extends Factory
{
    protected $model = Talento::class;

    public function definition(): array
    {
        $desde = fake()->numberBetween(300000, 1200000);

        return [
            'user_id' => User::factory(),
            'edad' => fake()->numberBetween(18, 60),
            'genero' => fake()->randomElement(['Masculino', 'Femenino', 'No binario', 'Otro']),
            'telefono' => fake()->phoneNumber(),
            'direccion' => fake()->address(),
            'resumen' => fake()->paragraph(3),
            'renta_desde' => $desde,
            'renta_hasta' => $desde + fake()->numberBetween(100000, 800000),
            'condicion_jornada' => fake()->randomElement(['Full-Time', 'Part-Time', 'Freelance']),
            'condicion_modalidad' => fake()->randomElement(['Presencial', 'Remoto', 'Híbrido']),
            'discapacidad' => fake()->boolean(20),
            'validacion' => true,
        ];
    }
}
