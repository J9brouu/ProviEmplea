<?php

namespace Database\Factories;

use App\Models\Talento;
use App\Models\TalentoArchivo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TalentoArchivo>
 */
class TalentoArchivoFactory extends Factory
{
    protected $model = TalentoArchivo::class;

    public function definition(): array
    {
        $tipo = fake()->randomElement(['cv', 'residencia']);
        return [
            'talento_id'     => Talento::factory(),
            'tipo_archivo'   => $tipo,
            'nombre_archivo' => $tipo === 'cv' ? 'curriculum.pdf' : 'residencia.pdf',
            'url_archivo'    => "documentos/talento/1/{$tipo}.pdf",
        ];
    }
}
