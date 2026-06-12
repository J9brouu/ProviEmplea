<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function descargar()
    {
        $talento = Talento::where('user_id', Auth::id())
            ->with(['user', 'antecedentesEducacionales', 'antecedentesLaborales',
                    'competenciasTecnicas', 'idiomas', 'perfeccionamientos'])
            ->firstOrFail();

        $pdf = Pdf::loadView('talento.cv-pdf', [
            'talento'          => $talento,
            'educacion'        => $talento->antecedentesEducacionales,
            'experiencia'      => $talento->antecedentesLaborales,
            'competencias'     => $talento->competenciasTecnicas,
            'idiomas'          => $talento->idiomas,
            'perfeccionamientos' => $talento->perfeccionamientos,
        ])->setPaper('a4', 'portrait');

        $nombre = 'CV_' . str_replace(' ', '_', $talento->user->name) . '_ProviEmplea.pdf';

        return $pdf->download($nombre);
    }
}
