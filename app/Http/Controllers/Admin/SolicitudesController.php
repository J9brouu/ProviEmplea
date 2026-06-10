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
            ->when($buscar, function ($query) use ($buscar) {
                $query->whereHas('datosEmpresa.user', fn($q) => $q->where('name', 'LIKE', "%{$buscar}%"));
            })
            ->latest()
            ->paginate(5);

        $conteos = Interacciones::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        $totales = [
            'pendiente'    => $conteos->get('pendiente', 0),
            'contactado'   => $conteos->get('contactado', 0),
            'entrevista'   => $conteos->get('entrevista', 0),
            'seleccionado' => $conteos->get('seleccionado', 0),
            'contratado'   => $conteos->get('contratado', 0),
        ];

        return view('admin.solicitudes', compact('solicitudes', 'totales'));
    }

    public function nota(Request $request, int $id)
    {
        Interacciones::findOrFail($id)->update(['notas' => $request->notas]);
        return back()->with('success', 'Nota guardada');
    }

    public function aprobar(int $id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'contactado']);
        return back()->with('success', 'Solicitud aprobada');
    }

    public function contactar(int $id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'contactado']);
        return back()->with('success', 'Talento contactado');
    }

    public function entrevista(int $id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'entrevista']);
        return back()->with('success', 'Entrevista programada');
    }

    public function seleccionado(int $id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'seleccionado']);
        return back()->with('success', 'Talento seleccionado');
    }

    public function contratar(int $id)
    {
        Interacciones::findOrFail($id)->update(['estado' => 'contratado']);
        return back()->with('success', 'Talento marcado como contratado. Ya no será visible en la vitrina.');
    }

    public function rechazar(int $id)
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
