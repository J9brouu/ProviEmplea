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
        return [
            'talento_id' => Talento::factory(),
            'tipo_archivo' => fake()->randomElement(['CV', 'Carta', 'Certificado']),
            'url_archivo' => fake()->url(),
        ];
    }
}
