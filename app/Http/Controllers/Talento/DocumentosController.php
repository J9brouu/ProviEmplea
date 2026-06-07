<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use App\Models\TalentoArchivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public const TIPOS = [
        'cv'          => ['label' => 'Curriculum Vitae',                  'mimes' => 'pdf,doc,docx',              'max' => 5120],
        'residencia'  => ['label' => 'Certificado de Residencia',         'mimes' => 'pdf,doc,docx,png,jpg,jpeg', 'max' => 5120],
        'discapacidad'=> ['label' => 'Certificado Ley 21.015 (Discapacidad)', 'mimes' => 'pdf,doc,docx,png,jpg,jpeg', 'max' => 5120],
    ];

    public function index()
    {
        $talento    = Talento::where('user_id', Auth::id())->firstOrFail();
        $documentos = TalentoArchivo::where('talento_id', $talento->id)->latest()->get();
        $tipos      = self::TIPOS;

        return view('talento.documentos', compact('documentos', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_archivo' => 'required|in:cv,residencia,discapacidad',
            'archivo'      => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
        ], [
            'archivo.mimes' => 'El archivo debe ser PDF, Word, PNG o JPG.',
            'archivo.max'   => 'El archivo no puede superar 5MB.',
        ]);

        $talento = Talento::where('user_id', Auth::id())->firstOrFail();
        $tipo    = $request->tipo_archivo;

        // Solo puede haber 1 de cada tipo — eliminar el anterior si existe
        $anterior = TalentoArchivo::where('talento_id', $talento->id)
            ->where('tipo_archivo', $tipo)->first();

        if ($anterior) {
            Storage::disk('public')->delete($anterior->url_archivo);
            $anterior->delete();
        }

        $archivo      = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        $ruta         = $archivo->store("documentos/talento/{$talento->id}", 'public');

        TalentoArchivo::create([
            'talento_id'     => $talento->id,
            'tipo_archivo'   => $tipo,
            'nombre_archivo' => $nombreOriginal,
            'url_archivo'    => $ruta,
        ]);

        // Volver a pendiente para que el admin lo revise
        $talento->user->update(['estado' => 'pendiente']);

        return back()->with('success', 'Documento subido. Quedará en revisión hasta que el admin lo apruebe.');
    }

    public function destroy($id)
    {
        $talento   = Talento::where('user_id', Auth::id())->firstOrFail();
        $documento = TalentoArchivo::where('id', $id)
            ->where('talento_id', $talento->id)->firstOrFail();

        Storage::disk('public')->delete($documento->url_archivo);

        // Si elimina el cert. de discapacidad, limpiar el campo
        if ($documento->tipo_archivo === 'discapacidad') {
            $talento->update(['discapacidad' => 0]);
        }

        $documento->delete();

        return back()->with('success', 'Documento eliminado correctamente.');
    }
}
