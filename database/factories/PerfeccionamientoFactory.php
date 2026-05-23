<?php

namespace Database\Factories;

use App\Models\Perfeccionamiento;
use App\Models\Talento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Perfeccionamiento>
 */
class PerfeccionamientoFactory extends Factory
{
    protected $model = Perfeccionamiento::class;

    public function definition(): array
    {
        $ingreso = fake()->dateTimeBetween('-6 years', '-1 years');
        $egreso = fake()->dateTimeBetween($ingreso, 'now');

        return [
            'talento_id' => Talento::factory(),
            'tipo' => fake()->randomElement(['Curso', 'Diplomado', 'Certificación', 'Bootcamp']),
            'institucion' => fake()->company(),
            'nombre_curso' => fake()->sentence(3),
            'ingreso' => $ingreso->format('Y-m-d'),
            'egreso' => $egreso->format('Y-m-d'),
        ];
    }
}
