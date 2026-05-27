<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interacciones;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudesController extends Controller
{

    //LISTAR SOLICITUDES
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $solicitudes = Interacciones::with([
            'talento.user',
            'datosEmpresa.user'
        ])

            ->when($buscar, function ($query) use ($buscar) {

                $query->whereHas('talento.user', function ($q) use ($buscar) {

                    $q->where('name', 'LIKE', "%{$buscar}%");
                });
            })

            ->latest()

            ->paginate(5);

        return view('admin.solicitudes', compact('solicitudes'));
    }


    //CONTACTAR TALENTO
public function contactar($id)
{
    $solicitud = Interacciones::findOrFail($id);

    $solicitud->update([
        'estado' => 'contactado'
    ]);

    return back()->with('success', 'Talento contactado');
}


//PASAR A ENTREVISTA
public function entrevista($id)
{
    $solicitud = Interacciones::findOrFail($id);

    $solicitud->update([
        'estado' => 'entrevista'
    ]);

    return back()->with('success', 'Entrevista programada');
}


//SELECCIONAR TALENTO
public function seleccionado($id)
{
    $solicitud = Interacciones::findOrFail($id);

    $solicitud->update([
        'estado' => 'seleccionado'
    ]);

    return back()->with('success', 'Talento seleccionado');
}


//RECHAZAR SOLICITUD
public function rechazar($id)
{
    $solicitud = Interacciones::findOrFail($id);

    $solicitud->update([
        'estado' => 'rechazado'
    ]);

    return back()->with('success', 'Solicitud rechazada');
}
    public function pdf()
    {
        $solicitudes = Interacciones::with([
            'talento.user',
            'datosEmpresa.user'
        ])->get();

        $pdf = Pdf::loadView(
            'admin.pdf.solicitudes',
            compact('solicitudes')
        );

        return $pdf->download('reporte-solicitudes.pdf');
    }
    
}
