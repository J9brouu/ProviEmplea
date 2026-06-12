<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\TalentosExport;
use App\Exports\EmpresasExport;
use App\Exports\ProcesosExport;
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
}
