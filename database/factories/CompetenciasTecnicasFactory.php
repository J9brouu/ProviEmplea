<?php

namespace Database\Factories;

use App\Models\CompetenciasTecnicas;
use App\Models\Talento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompetenciasTecnicas>
 */
class CompetenciasTecnicasFactory extends Factory
{
    protected $model = CompetenciasTecnicas::class;

    public function definition(): array
    {
        return [
            'talento_id' => Talento::factory(),
            'nombre_competencia' => fake()->randomElement([
                'Laravel',
                'Vue.js',
                'React',
                'MySQL',
                'PHP',
                'Node.js',
                'Git',
                'Docker',
            ]),
        ];
    }
}
