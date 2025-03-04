<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PresenceExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $presenceQuery;

    // Konstruktor menerima query yang difilter dari controller
    public function __construct($presenceQuery)
    {
        $this->presenceQuery = $presenceQuery;
    }

    // Mengambil data presence yang sudah difilter
    public function collection()
    {
        return $this->presenceQuery->get();
    }

    // Header untuk kolom di file Excel
    public function headings(): array
    {
        return [
            'Tanggal Presensi',
            'Nama Peserta',
            'Keterangan',
            'Waktu Presensi',
            'Status'
        ];
    }

    protected function formatValue($value)
    {
        return match ($value) {
            'hadir' => 'Hadir',
            'sakit' => 'Sakit',
            'ijin' => 'Ijin',
            'alfa' => 'Tanpa Keterangan',
        };
    }
    protected function formatStatus($status)
    {
        return match ($status) {
            1 => 'Tepat Waktu',
            0 => 'Terlambat',
        };
    }

    public function map($presence): array
    {
        return [
            $presence->presence_date,
            $presence->intern->name,
            $this->formatValue($presence->value),
            $presence->presence_time,
            $this->formatStatus($presence->status),
        ];
    }

    // Event untuk menyesuaikan tampilan di Excel
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Mengatur AutoSize untuk semua kolom
                foreach (range('A', 'E') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Mengatur gaya pada heading
                $sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'bold' => true, // Teks tebal
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Teks rata tengah
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,    // Teks rata tengah vertikal
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFD700', // Warna kuning terang
                        ],
                    ],
                ]);

                // Meningkatkan tinggi baris heading
                $sheet->getRowDimension(1)->setRowHeight(25);
            },
        ];
    }
}
