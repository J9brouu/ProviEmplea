<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\ArchivoEmpresa;
use App\Models\DatosEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentosController extends Controller
{
    private const TIPOS_PERMITIDOS = [
        'Escritura Empresa',
        'RUT Empresa',
        'Certificado SII',
        'Contrato',
        'Acreditación',
        'Otro',
    ];

    public function index()
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        // Excluye 'contenido' para no cargar binarios en el listado
        $documentos = ArchivoEmpresa::where('datos_empresa_id', $empresa->id)
            ->select(['id', 'datos_empresa_id', 'tipo_archivo', 'nombre_archivo', 'mime_type', 'estado', 'motivo_rechazo', 'created_at', 'updated_at'])
            ->latest()
            ->get();

        $tipos = self::TIPOS_PERMITIDOS;

        return view('empresa.documentos', compact('empresa', 'documentos', 'tipos'));
    }

    public function store(Request $request)
    {
        $tiposValidos = implode(',', self::TIPOS_PERMITIDOS);

        $request->validate([
            'archivo'      => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
            'tipo_archivo' => "required|in:{$tiposValidos}",
        ], [
            'archivo.mimes'   => 'El archivo debe ser PDF, Word, PNG o JPG.',
            'archivo.max'     => 'El archivo no puede superar 5MB.',
            'tipo_archivo.in' => 'El tipo de documento no es válido.',
        ]);

        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();
        $file    = $request->file('archivo');

        ArchivoEmpresa::create([
            'datos_empresa_id' => $empresa->id,
            'tipo_archivo'     => $request->tipo_archivo,
            'nombre_archivo'   => $file->getClientOriginalName(),
            'contenido'        => base64_encode(file_get_contents($file->getRealPath())),
            'mime_type'        => $file->getMimeType(),
        ]);

        // Volver a pendiente para que el admin revise el nuevo documento
        $empresa->user->update(['estado' => 'pendiente']);

        return back()->with('success', 'Documento subido. Quedará en revisión hasta que el admin lo apruebe.');
    }

    public function destroy(int $id)
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $archivo = ArchivoEmpresa::where('id', $id)
            ->where('datos_empresa_id', $empresa->id)
            ->firstOrFail();

        $archivo->delete();

        return back()->with('success', 'Documento eliminado.');
    }
}
