<?php

namespace App\Exports;

use App\Models\Talento;
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

class TalentosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    public function collection()
    {
        return Talento::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Correo', 'Estado', 'Género', 'Edad',
            'Teléfono', 'Dirección', 'Jornada', 'Modalidad',
            'Renta Desde', 'Renta Hasta', 'Discapacidad', 'Validado',
        ];
    }

    public function map($talento): array
    {
        return [
            $talento->id,
            $talento->user->name ?? '',
            $talento->user->email ?? '',
            $talento->user->estado ?? '',
            $talento->genero,
            $talento->edad,
            $talento->telefono,
            $talento->direccion,
            $talento->condicion_jornada,
            $talento->condicion_modalidad,
            $talento->renta_desde,
            $talento->renta_hasta,
            $talento->discapacidad ? 'Sí' : 'No',
            $talento->validacion ? 'Sí' : 'No',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,  'B' => 28, 'C' => 32, 'D' => 12,
            'E' => 12, 'F' => 8,  'G' => 18, 'H' => 30,
            'I' => 14, 'J' => 14, 'K' => 14, 'L' => 14,
            'M' => 14, 'N' => 12,
        ];
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
                $lastCol = 'N';

                for ($i = 2; $i <= $lastRow; $i++) {
                    $color = $i % 2 === 0 ? 'FFF1F5FF' : 'FFFFFFFF';
                    $sheet->getStyle("A{$i}:{$lastCol}{$i}")->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($color);
                }

                $sheet->getStyle("A1:{$lastCol}{$lastRow}")->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->getColor()->setARGB('FFD1D5DB');

                $sheet->setAutoFilter("A1:{$lastCol}1");
                $sheet->freezePane('A2');
            },
        ];
    }
}
