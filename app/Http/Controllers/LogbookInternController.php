<?php

namespace App\Http\Controllers;

use App\Exports\LogbookExport;
use App\Exports\LogbookInternExport;
use App\Models\Interns;
use App\Models\LogbookIntern;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class LogbookInternController extends Controller
{
    //Menampilkan logbook milik user yang melakukan login :intern
    public function index(): View
    {
        // Ambil data intern dari session
        $internSession = session('intern');

        // Ambil id intern dari session
        $internId = $internSession->id;

        // Dapatkan tanggal hari ini
        $today = Carbon::today();

        // Query logbook yang sesuai dengan intern_id dan filter berdasarkan tanggal (opsional)
        $logbookInterns = LogbookIntern::where('intern_id', $internId)
            ->whereDate('date_logbook', '<=', $today)  // Filter berdasarkan tanggal logbook
            ->orderBy('date_logbook', 'desc')  // Urutkan berdasarkan tanggal logbook
            ->get();

        // Kirim data logbookInterns ke view
        return view('logbook.logbook', compact('logbookInterns'));
    }

    public function logbooks(Request $request): View
    {
        $tanggalAwal = $request->query('tanggal_awal');
        $tanggalAkhir = $request->query('tanggal_akhir');

        $logbooks = collect(); // Default nilai kosong

        if ($tanggalAwal && $tanggalAkhir) {
            $logbooks = LogbookIntern::whereBetween('date_logbook', [$tanggalAwal, $tanggalAkhir])->get();
        }

        return view('cetak.cetak_logbook', compact('logbooks', 'tanggalAwal', 'tanggalAkhir'));
    }

    // Mengekspor data logbook ke Excel
    public function export(Request $request)
    {
        $tanggalAwal = $request->query('tanggal_awal');
        $tanggalAkhir = $request->query('tanggal_akhir');

        $logbooksQuery = LogbookIntern::query();

        if ($tanggalAwal && $tanggalAkhir) {
            $logbooksQuery->whereBetween('date_logbook', [$tanggalAwal, $tanggalAkhir]);
        }

        // Export data logbook yang sudah difilter
        return Excel::download(new LogbookExport($logbooksQuery), "Logbook_{$tanggalAwal}_to_{$tanggalAkhir}.xlsx");
    }

    public function exportLogbookIntern(Request $request)
    {
        $intern_id = $request->input('intern_id');

        // Ambil data peserta berdasarkan intern_id
        $intern = Interns::find($intern_id);

        // Jika peserta ditemukan, gunakan namanya untuk nama file
        if ($intern) {
            $fileName = 'Data_Logbook_' . str_replace(' ', '_', $intern->name) . '.xlsx';
        } else {
            $fileName = 'Data_Logbook.xlsx'; // Default jika peserta tidak ditemukan
        }

        // Download file dengan nama yang disesuaikan
        return Excel::download(new LogbookInternExport($intern_id), $fileName);
    }
    public function show($id)
    {
        $logbookIntern = LogbookIntern::findOrFail($id);
        return response()->json($logbookIntern);
    }

    //Mengarahkan ketampilan edit logbook :intern
    public function edit($id): View
    {
        $logbookIntern = LogbookIntern::findOrFail($id);
        return view('logbook.logbook_edit', compact('logbookIntern'));
    }

    //Melakukan update pada perubahan logbook :intern
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'job_description' => 'required',
            'completion_stat' => 'required',
            'processing_time' => 'required',
            'divisi' => 'required'
        ]);

        $logbookIntern = LogbookIntern::findOrFail($id);
        $logbookIntern->update($validated);
        return redirect()->route('activity.logbook')->with('success', 'Logbook berhasil diperbarui');
    }

    //Menampilkan seluruh data logbok berdasarkan peserta :admin
    public function getLogbookByIntern(): View
    {
        $logbookInterns = LogbookIntern::with('intern')
            ->whereHas('intern', function ($query) {
                $query->whereNotNull('division_id')->where('role', 'intern');
            })
            ->get()
            ->groupBy(function ($logbook) {
                return $logbook->intern->name;
            });

        $logbookCounts = $logbookInterns->map(function ($group) {
            // Mengambil data yang diperlukan dari intern pertama
            $intern = $group->first()->intern;

            // Menghitung total logbook dan jumlah logbook yang terisi kolom-kolom tertentu
            $filledLogbookCount = collect(['job_description', 'title', 'completion_stat', 'processing_time', 'divisi'])
                ->map(fn($field) => $group->filter(fn($logbook) => !is_null($logbook->$field))->count())
                ->min();  // Mengambil jumlah minimal dari kolom yang terisi

            return [
                'name' => $intern->name,
                'school_name' => $intern->school_name,
                'total_logbook_count' => $group->count(),
                'filled_logbook_count' => $filledLogbookCount,
                'intern_id' => $group->first()->intern_id
            ];
        });

        return view('logbook.logbook_interns', compact('logbookCounts'));
    }

    //Menampilkan detail logbook intern yang sudah di groupBy :admin
    public function showDetailLogbook($internId)
    {
        $logbookInterns = LogbookIntern::where('intern_id', $internId)->get();
        if ($logbookInterns->isEmpty()) {
            return redirect()->route('activity.logbook')->with('error', 'Tidak ada peserta untuk logbook ini.');
        }

        return view('logbook.logbook_interns_detail', compact('logbookInterns', 'internId'));
    }
}
