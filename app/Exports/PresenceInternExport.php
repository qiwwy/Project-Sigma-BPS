<?php

namespace App\Exports;

use App\Models\LogbookIntern;
use App\Models\Presence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PresenceInternExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $intern_id;

    public function __construct($intern_id)
    {
        $this->intern_id = $intern_id;
    }

    // Mengambil data dari database
    public function collection()
    {
        return Presence::where('intern_id', $this->intern_id)
            ->get(['presence_date', 'intern_id', 'value', 'presence_time', 'status']);
    }

    // Header kolom
    public function headings(): array
    {
        return [
            'Tanggal Presensi',
            'Nama Peserta',
            'Kehadiran',
            'Waktu Presensi',
            'Status',
        ];
    }

    // Mapping data untuk menyesuaikan output
    public function map($presence): array
    {
        return [
            $presence->presence_date,
            $presence->intern->name ?? 'Belum Diisi',
            $presence->value ?? 'Belum Diisi',
            $presence->presence_time ?? 'Belum Diisi',
            $presence->status ?? 'Belum Diisi',
        ];
    }

    // Event untuk styling tampilan Excel
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Mengatur AutoSize untuk semua kolom (A-H)
                foreach (range('A', 'H') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Mengatur gaya pada heading (row pertama)
                $sheet->getStyle('A1:H1')->applyFromArray([
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

                // Mengatur tinggi baris header
                $sheet->getRowDimension(1)->setRowHeight(25);
            },
        ];
    }
}
