<?php

namespace Database\Factories;

use App\Models\DatosEmpresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DatosEmpresa>
 */
class DatosEmpresaFactory extends Factory
{
    protected $model = DatosEmpresa::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'rut_empresa' => fake()->unique()->numerify('########-#'),
            'rubro_empresa' => fake()->company(),
            'tipo_empresa' => fake()->randomElement(['Startup', 'Pyme', 'Multinacional', 'ONG']),
            'presentacion_empresa' => fake()->paragraph(3),
            'beneficios_empresa' => fake()->paragraph(2),
            'validacion' => true,
        ];
    }
}
