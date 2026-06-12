<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interacciones;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudesController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $solicitudes = Interacciones::with(['talento.user', 'datosEmpresa.user'])
            ->when($buscar, fn ($q) =>
                $q->whereHas('datosEmpresa.user', fn($s) => $s->where('name', 'LIKE', "%{$buscar}%"))
                  ->orWhereHas('talento.user', fn($s) => $s->where('name', 'LIKE', "%{$buscar}%"))
            )
            ->when($request->filled('estado'), fn ($q) => $q->where('estado', $request->estado))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totales = [
            'pendiente'    => Interacciones::where('estado', 'pendiente')->count(),
            'contactado'   => Interacciones::where('estado', 'contactado')->count(),
            'entrevista'   => Interacciones::where('estado', 'entrevista')->count(),
            'seleccionado' => Interacciones::where('estado', 'seleccionado')->count(),
            'contratado'   => Interacciones::where('estado', 'contratado')->count(),
        ];

        return view('admin.solicitudes', compact('solicitudes', 'totales'));
    }

    public function nota(Request $request, $id)
    {
        Interacciones::findOrFail($id)->update(['notas' => $request->notas]);
        return back()->with('success', 'Nota guardada');
    }

    public function aprobar($id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'contactado']);
        return back()->with('success', 'Solicitud aprobada');
    }

    public function contactar($id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'contactado']);
        return back()->with('success', 'Talento contactado');
    }

    public function entrevista($id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'entrevista']);
        return back()->with('success', 'Entrevista programada');
    }

    public function seleccionado($id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'seleccionado']);
        return back()->with('success', 'Talento seleccionado');
    }

    public function contratar($id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'contratado']);
        return back()->with('success', 'Talento marcado como contratado. Ya no será visible en la vitrina.');
    }

    public function rechazar($id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'rechazado']);
        return back()->with('success', 'Solicitud rechazada');
    }

    public function pdf()
    {
        $solicitudes = Interacciones::with(['talento.user', 'datosEmpresa.user'])->get();
        $pdf = Pdf::loadView('admin.pdf.solicitudes', compact('solicitudes'));
        return $pdf->download('reporte-solicitudes.pdf');
    }
}
