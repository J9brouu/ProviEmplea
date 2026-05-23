<?php

namespace Database\Factories;

use App\Models\AntecedentesLaborales;
use App\Models\Talento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AntecedentesLaborales>
 */
class AntecedentesLaboralesFactory extends Factory
{
    protected $model = AntecedentesLaborales::class;

    public function definition(): array
    {
        $ingreso = fake()->dateTimeBetween('-10 years', '-2 years');
        $egreso = fake()->dateTimeBetween($ingreso, 'now');

        return [
            'talento_id' => Talento::factory(),
            'institucion_o_empresa' => fake()->company(),
            'ingreso' => $ingreso->format('Y-m-d'),
            'egreso' => $egreso->format('Y-m-d'),
            'cargo' => fake()->jobTitle(),
            'funciones' => fake()->paragraph(2),
            'referencia_nombre' => fake()->name(),
            'referencia_telefono' => fake()->phoneNumber(),
            'referencia_correo' => fake()->safeEmail(),
            'referencia_cargo' => fake()->jobTitle(),
        ];
    }
}
