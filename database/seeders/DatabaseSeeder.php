<?php

namespace Database\Seeders;

use App\Models\AntecedentesEducacionales;
use App\Models\AntecedentesLaborales;
use App\Models\CompetenciasTecnicas;
use App\Models\DatosEmpresa;
use App\Models\Perfeccionamiento;
use App\Models\Talento;
use App\Models\TalentoArchivo;
use App\Models\TalentoIdioma;
use App\Models\UsuariosEmpresa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ADMIN
        User::factory()->create([
            'name'   => 'Admin',
            'email'  => 'admin@admin.com',
            'rol'    => 'admin',
            'estado' => 'activo',
        ]);

        // TALENTO DE PRUEBA (pendiente, sin archivos — los sube él mismo)
        $talentoUsers = User::factory()->count(3)->talento()->create();
        foreach ($talentoUsers as $user) {
            $talento = Talento::factory()->create(['user_id' => $user->id]);
            AntecedentesEducacionales::factory()->count(1)->create(['talento_id' => $talento->id]);
            AntecedentesLaborales::factory()->count(1)->create(['talento_id' => $talento->id]);
            CompetenciasTecnicas::factory()->count(2)->create(['talento_id' => $talento->id]);
            Perfeccionamiento::factory()->count(1)->create(['talento_id' => $talento->id]);

            $idiomas = collect(['Español', 'Inglés', 'Portugués', 'Francés', 'Alemán', 'Italiano', 'Chino Mandarín', 'Árabe', 'Japonés', 'Ruso'])
                ->shuffle()
                ->take(rand(1, 3));

            foreach ($idiomas as $idioma) {
                TalentoIdioma::create([
                    'talento_id'    => $talento->id,
                    'nombre_idioma' => $idioma,
                    'nivel'         => fake()->randomElement(['Básico', 'Intermedio', 'Avanzado', 'Nativo']),
                ]);
            }
        }

        // EMPRESAS
        $empresaUsers = User::factory()->count(5)->empresa()->create();
        foreach ($empresaUsers as $user) {
            $datosEmpresa = DatosEmpresa::factory()->create(['user_id' => $user->id]);
            UsuariosEmpresa::factory()->create(['datos_empresa_id' => $datosEmpresa->id, 'user_id' => $user->id]);
        }
    }
}
