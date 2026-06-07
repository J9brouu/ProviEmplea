<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\ArchivoEmpresa;
use App\Models\DatosEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function index()
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $documentos = ArchivoEmpresa::where('datos_empresa_id', $empresa->id)
            ->latest()
            ->get();

        return view('empresa.documentos', compact('empresa', 'documentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'archivo'     => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
            'tipo_archivo'=> 'required|string|max:50',
        ]);

        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $file = $request->file('archivo');
        $path = $file->store('empresa/documentos', 'public');

        ArchivoEmpresa::create([
            'datos_empresa_id' => $empresa->id,
            'tipo_archivo'     => $request->tipo_archivo,
            'nombre_archivo'   => $file->getClientOriginalName(),
            'url_archivo'      => $path,
        ]);

        return back()->with('success', 'Documento subido correctamente.');
    }

    public function destroy($id)
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $archivo = ArchivoEmpresa::where('id', $id)
            ->where('datos_empresa_id', $empresa->id)
            ->firstOrFail();

        Storage::disk('public')->delete($archivo->url_archivo);
        $archivo->delete();

        return back()->with('success', 'Documento eliminado.');
    }
}
