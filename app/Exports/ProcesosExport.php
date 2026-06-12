<?php

namespace App\Exports;

use App\Models\Interacciones;
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

class ProcesosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    public function collection()
    {
        return Interacciones::with(['datosEmpresa.user', 'talento.user'])->get();
    }

    public function headings(): array
    {
        return ['ID', 'Empresa', 'Talento', 'Estado', 'Fecha Contacto', 'Notas'];
    }

    public function map($proceso): array
    {
        return [
            $proceso->id,
            $proceso->datosEmpresa->user->name ?? '',
            $proceso->talento->user->name ?? '',
            ucfirst($proceso->estado),
            $proceso->fecha_contacto ?? '',
            $proceso->notas ?? '',
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 8, 'B' => 30, 'C' => 30, 'D' => 15, 'E' => 18, 'F' => 45];
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
                    $sheet->getStyle("A{$i}:F{$i}")->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($color);
                }

                $sheet->getStyle("A1:F{$lastRow}")->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->getColor()->setARGB('FFD1D5DB');

                $sheet->setAutoFilter("A1:F1");
                $sheet->freezePane('A2');
            },
        ];
    }
}
