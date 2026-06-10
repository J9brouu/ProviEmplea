<?php

namespace App\Http\Controllers;

use App\Models\ArchivoEmpresa;
use App\Models\DatosEmpresa;
use App\Models\Talento;
use App\Models\TalentoArchivo;
use Illuminate\Support\Facades\Auth;

class ArchivoController extends Controller
{
    public function talento(int $id)
    {
        $archivo = TalentoArchivo::select(['id', 'talento_id', 'nombre_archivo', 'mime_type', 'contenido'])
            ->findOrFail($id);

        $user = Auth::user();

        if ($user->rol === 'admin') {
            // Admin puede ver todos los archivos
        } elseif ($user->rol === 'talento') {
            $talento = Talento::where('user_id', $user->id)->firstOrFail();
            if ($archivo->talento_id !== $talento->id) {
                abort(403);
            }
        } else {
            abort(403);
        }

        if (!$archivo->contenido) {
            abort(404, 'Archivo no disponible.');
        }

        return response(base64_decode($archivo->contenido), 200)
            ->header('Content-Type', $archivo->mime_type ?? 'application/octet-stream')
            ->header('Content-Disposition', 'inline; filename="' . $archivo->nombre_archivo . '"');
    }

    public function empresa(int $id)
    {
        $archivo = ArchivoEmpresa::select(['id', 'datos_empresa_id', 'nombre_archivo', 'mime_type', 'contenido'])
            ->findOrFail($id);

        $user = Auth::user();

        if ($user->rol === 'admin') {
            // Admin puede ver todos los archivos
        } elseif ($user->rol === 'empresa') {
            $empresa = DatosEmpresa::where('user_id', $user->id)->firstOrFail();
            if ($archivo->datos_empresa_id !== $empresa->id) {
                abort(403);
            }
        } else {
            abort(403);
        }

        if (!$archivo->contenido) {
            abort(404, 'Archivo no disponible.');
        }

        return response(base64_decode($archivo->contenido), 200)
            ->header('Content-Type', $archivo->mime_type ?? 'application/octet-stream')
            ->header('Content-Disposition', 'inline; filename="' . $archivo->nombre_archivo . '"');
    }

    public function logo(int $id)
    {
        $empresa = DatosEmpresa::select(['id', 'logo_contenido', 'logo_mime'])
            ->findOrFail($id);

        if (!$empresa->logo_contenido) {
            abort(404, 'Logo no disponible.');
        }

        return response(base64_decode($empresa->logo_contenido), 200)
            ->header('Content-Type', $empresa->logo_mime ?? 'image/jpeg')
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
