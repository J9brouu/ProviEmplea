<?php

namespace Database\Factories;

use App\Models\AntecedentesEducacionales;
use App\Models\Talento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AntecedentesEducacionales>
 */
class AntecedentesEducacionalesFactory extends Factory
{
    protected $model = AntecedentesEducacionales::class;

    public function definition(): array
    {
        $ingreso = fake()->dateTimeBetween('-10 years', '-3 years');
        $egreso = fake()->dateTimeBetween($ingreso, 'now');

        return [
            'talento_id' => Talento::factory(),
            'nombre_institucion' => fake()->company(),
            'ingreso' => $ingreso->format('Y-m-d'),
            'egreso' => $egreso->format('Y-m-d'),
            'completo' => fake()->boolean(80),
            'titulo' => fake()->jobTitle(),
        ];
    }
}
