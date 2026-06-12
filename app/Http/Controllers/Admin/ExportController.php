<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\TalentosExport;
use App\Exports\EmpresasExport;
use App\Exports\ProcesosExport;
use App\Models\Talento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function talentos()
    {
        return Excel::download(new TalentosExport, 'talentos_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function empresas()
    {
        return Excel::download(new EmpresasExport, 'empresas_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function procesos()
    {
        return Excel::download(new ProcesosExport, 'procesos_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function cvsBulk(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('error', 'Debes seleccionar al menos un talento.');
        }

        $talentos = Talento::whereIn('id', $ids)
            ->with(['user', 'antecedentesEducacionales', 'antecedentesLaborales',
                    'competenciasTecnicas', 'idiomas', 'perfeccionamientos'])
            ->get();

        $html = '';
        foreach ($talentos as $index => $talento) {
            $pageBreak = $index > 0 ? '<div style="page-break-before:always;"></div>' : '';
            $html .= $pageBreak . view('talento.cv-pdf', [
                'talento'            => $talento,
                'educacion'          => $talento->antecedentesEducacionales,
                'experiencia'        => $talento->antecedentesLaborales,
                'competencias'       => $talento->competenciasTecnicas,
                'idiomas'            => $talento->idiomas,
                'perfeccionamientos' => $talento->perfeccionamientos,
            ])->render();
        }

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
        $nombre = 'CVs_ProviEmplea_' . now()->format('d-m-Y') . '.pdf';

        return $pdf->download($nombre);
    }
}
