<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use App\Models\TalentoIdioma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdiomasController extends Controller
{
    public const LISTA_IDIOMAS = [
        'Español', 'Inglés', 'Portugués', 'Francés',
        'Alemán', 'Italiano', 'Chino Mandarín', 'Otro',
    ];

    public const NIVELES = ['Básico', 'Intermedio', 'Avanzado', 'Nativo'];

    public function store(Request $request)
    {
        $request->validate([
            'idiomas'          => 'nullable|array',
            'idiomas.*.nombre' => 'required|string|max:100',
            'idiomas.*.nivel'  => 'required|in:Básico,Intermedio,Avanzado,Nativo',
        ]);

        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        TalentoIdioma::where('talento_id', $talento->id)->delete();

        foreach ($request->idiomas ?? [] as $idioma) {
            if (!empty($idioma['nombre']) && !empty($idioma['nivel'])) {
                TalentoIdioma::create([
                    'talento_id'    => $talento->id,
                    'nombre_idioma' => $idioma['nombre'],
                    'nivel'         => $idioma['nivel'],
                ]);
            }
        }

        return back()->with('success', 'Idiomas actualizados correctamente.');
    }
}
