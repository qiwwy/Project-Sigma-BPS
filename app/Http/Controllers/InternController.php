<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\LogbookIntern;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Interns;
use App\Models\LastDateInterns;

class InternController extends Controller
{
    public function index(): View
    {
        $interns = Interns::where('status', 'Active')
            ->whereNotNull('division_id')
            ->get();
        return view('master.interns', compact('interns'));
    }

    public function certificateIntern(): View
    {
        $interns = Interns::where('role', 'intern')
            ->whereNotNull('division_id')
            ->with(['logbooks', 'presences']) // Load relasi logbooks dan presences
            ->get()
            ->map(function ($intern) {
                // Hitung rata-rata poin logbook
                $intern->average_points = $intern->logbooks->avg('point');

                // Hitung nilai presensi
                $attendanceValues = $intern->presences->map(function ($presence) {
                    // Ubah status 'hadir' ke nilai 100 dan lainnya ke 0
                    return $presence->value === 'hadir' ? 100 : 0;
                });

                $intern->attendance_score = $attendanceValues->avg() ?? 0;

                return $intern;
            });

        return view('monitoring.certificate-intern', compact('interns'));
    }

    public function getInternsByDivision(): View
    {
        // Ambil division_id dari sesi intern yang sedang login
        $internSession = session('intern');
        $divisionId = $internSession->division_id;

        // Ambil intern berdasarkan division_id dan role 'intern', beserta relasi logbooks dan presences
        $internDivisionId = Interns::where('division_id', $divisionId)
            ->where('role', 'intern')
            ->get();

        return view('mentor.intern_by_division', compact('internDivisionId'));
    }

    public function showLogbookByIntern($internId): View
    {
        // Mengambil data intern beserta logbooks yang terkait
        $intern = Interns::with('logbooks')->findOrFail($internId);

        // Menghitung total point dari logbooks
        $totalPoint = $intern->logbooks->sum('point');  // Menjumlahkan semua point
        $totalLogbooks = $intern->logbooks->count();    // Menghitung jumlah logbooks

        // Menghitung rata-rata point, jika ada logbook
        $averagePoint = $totalLogbooks > 0 ? $totalPoint / $totalLogbooks : 0;

        // Mengirim data intern, totalPoint, dan averagePoint ke view
        return view('logbook.logbook_interns_detail_mentor', compact('intern', 'totalPoint', 'averagePoint'));
    }

    public function edit($id): View
    {
        $logbook = LogbookIntern::findOrFail($id);
        return view('mentor.logbook_point_edit', compact('logbook'));
    }
    public function updatePoint(Request $request, $id)
    {
        $validated = $request->validate([
            'point' => 'required',
        ]);

        $logbookIntern = LogbookIntern::findOrFail($id);
        $logbookIntern->update($validated);
        return redirect(route('mentor.internByDivision'))->with('success', 'Nilai berhasil disimpan!');
    }

    public function dispositionIntern(): View
    {
        $interns = Interns::where('status', 'Active')->whereNull('division_id')->get();
        $divisions = Division::all(); // Ambil semua data divisi
        return view('monitoring.disposition', compact('interns', 'divisions'));
    }

    public function updateDisposition(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required',
        ]);

        $intern = Interns::findOrFail($id);

        $intern->division_id = $request->input('division_id');
        $intern->save();

        return redirect()->route('interns.index')->with(['successDisposition' => 'Penetapan divisi pada peserta telah berhasil.']);
    }

    public function getEndDateUnique()
    {
        $interns = Interns::where('status', 'Active')->get();

        $endDateUnique = $interns->pluck('end_date')->filter();
        $endDateUniqueCounts = $endDateUnique->countBy();
        $sortedEndDateCounts = $endDateUniqueCounts->sortKeys();

        foreach ($sortedEndDateCounts as $endDate => $count) {
            LastDateInterns::updateOrCreate(
                ['end_date' => $endDate],
                ['count' => $count]
            );
        }
        return redirect()->back()->with('success', 'Tanggal Tersedia Berhasil Diperbaharui');
    }
}
