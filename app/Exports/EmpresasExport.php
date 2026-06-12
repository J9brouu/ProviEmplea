<?php

namespace App\Exports;

use App\Models\DatosEmpresa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class EmpresasExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    public function collection()
    {
        return DatosEmpresa::with('user')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Correo', 'Estado', 'RUT', 'Rubro', 'Tipo', 'Validada'];
    }

    public function map($empresa): array
    {
        return [
            $empresa->id,
            $empresa->user->name ?? '',
            $empresa->user->email ?? '',
            $empresa->user->estado ?? '',
            $empresa->rut_empresa,
            $empresa->rubro_empresa,
            $empresa->tipo_empresa,
            $empresa->validacion ? 'Sí' : 'No',
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 8, 'B' => 30, 'C' => 32, 'D' => 12, 'E' => 16, 'F' => 28, 'G' => 16, 'H' => 12];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'size' => 11],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0B1739']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                for ($i = 2; $i <= $lastRow; $i++) {
                    $color = $i % 2 === 0 ? 'FFF1F5FF' : 'FFFFFFFF';
                    $sheet->getStyle("A{$i}:H{$i}")->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($color);
                }

                $sheet->getStyle("A1:H{$lastRow}")->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->getColor()->setARGB('FFD1D5DB');

                $sheet->setAutoFilter("A1:H1");
                $sheet->freezePane('A2');
            },
        ];
    }
}
