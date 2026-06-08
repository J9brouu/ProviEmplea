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
        $tipo = fake()->randomElement(['Documento', 'Logo', 'Presentación']);

        return [
            'datos_empresa_id' => DatosEmpresa::factory(),
            'tipo_archivo' => $tipo,
            'nombre_archivo' => match ($tipo) {
                'Documento' => 'documento.pdf',
                'Logo' => 'logo.png',
                'Presentación' => 'presentacion.pdf',
                default => 'archivo.pdf',
            },
            'url_archivo' => fake()->url(),
        ];
    }
}
