<?php

namespace Database\Factories;

use App\Models\DatosEmpresa;
use App\Models\User;
use App\Models\UsuariosEmpresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UsuariosEmpresa>
 */
class UsuariosEmpresaFactory extends Factory
{
    protected $model = UsuariosEmpresa::class;

    public function definition(): array
    {
        return [
            'datos_empresa_id' => DatosEmpresa::factory(),
            'user_id' => User::factory(),
            'telefono' => fake()->phoneNumber(),
        ];
    }
}
