<?php

namespace Database\Factories;

use App\Models\ArchivoEmpresa;
use App\Models\DatosEmpresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ArchivoEmpresa>
 */
class ArchivoEmpresaFactory extends Factory
{
    protected $model = ArchivoEmpresa::class;

    public function definition(): array
    {
        return [
            'datos_empresa_id' => DatosEmpresa::factory(),
            'tipo_archivo' => fake()->randomElement(['Documento', 'Logo', 'Presentación']),
            'url_archivo' => fake()->url(),
        ];
    }
}
