<?php

namespace App\Http\Controllers;

use App\Models\Interns;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(): View
    {
        $internSession = session('intern');
        $internId = $internSession->id;

        $presences = Presence::where('intern_id', $internId)->get();
        return view('presence.presences', compact('presences'));
    }

    public function presenceByDivision(): View
    {
        $internSession = session('intern');
        $divisionId = $internSession->division_id;

        $presences = Presence::whereHas('intern.division', function ($query) use ($divisionId) {
            $query->where('id', $divisionId);
        })->get();

        return view('mentor.presence_by_division', compact('presences'));
    }

    public function showPresenceByIntern($internId): View
    {
        // Mengambil data intern beserta presensinya
        $intern = Interns::with('presences')->findOrFail($internId);

        // Menghitung jumlah hari antara start_date dan end_date
        $startDate = Carbon::parse($intern->start_date);
        $endDate = Carbon::parse($intern->end_date);
        $totalDays = $startDate->diffInDays($endDate) + 1; // +1 karena menghitung hari pertama

        // Menghitung jumlah kehadiran 'hadir' dalam periode tersebut
        $hadirCount = $intern->presences->where('value', 'hadir')->count();

        // Menghitung presentasi kehadiran
        $attendancePercentage = $totalDays > 0 ? ($hadirCount / $totalDays) * 100 : 0;

        // Mengirim data ke view
        return view('presence.presence_interns_detail_mentor', compact(
            'intern',
            'hadirCount',
            'attendancePercentage',
            'totalDays'
        ));
    }


    public function store(Request $request): RedirectResponse
    {
        $internSession = session('intern');
        $internId = $internSession->id;

        $currentDate = now()->toDateString(); // Tanggal saat ini
        $currentTime = now()->toTimeString(); // Waktu saat ini (HH:mm:ss)

        // Cek apakah sudah ada data dengan intern_id dan tanggal yang sama
        $existingPresence = Presence::where('intern_id', $internId)
            ->where('presence_date', $currentDate)
            ->first();

        if ($existingPresence) {
            // Jika sudah ada, kembalikan dengan pesan error
            return redirect()->route('dashboard')->withErrors([
                'error' => 'Anda sudah melakukan absen hari ini!.',
            ]);
        }

        // Tentukan status presensi berdasarkan waktu masuk
        $status = null;

        // Logika untuk status presensi masuk
        if (now()->format('H:i') <= '08:00') {
            $status = true; // Presensi tepat waktu atau lebih awal
        } else {
            $status = false; // Presensi terlambat
        }

        // Simpan data baru ke tabel presences
        Presence::create([
            'intern_id' => $internId,
            'value' => 'hadir',
            'presence_time' => $currentTime,
            'presence_date' => $currentDate,
            'status' => $status,
        ]);

        return redirect()->route('dashboard')->with(['success' => 'Absen berhasil dicatat!']);
    }

    public function storebyMentor(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'intern_id' => 'required|exists:interns,id', // Pastikan intern_id valid
            'value' => 'required|in:hadir,ijin,sakit,alfa',   // Pastikan value adalah salah satu status yang valid
        ]);

        $internId = $request->intern_id;
        $currentDate = now()->toDateString(); // Tanggal saat ini
        $currentTime = now()->toTimeString(); // Waktu saat ini (HH:mm:ss)

        // Cek apakah sudah ada data dengan intern_id dan tanggal yang sama
        $existingPresence = Presence::where('intern_id', $internId)
            ->where('presence_date', $currentDate)
            ->first();

        if ($existingPresence) {
            // Jika sudah ada, kembalikan dengan pesan error
            return redirect()->route('dashboard')->withErrors([
                'error' => 'Intern sudah melakukan absen hari ini!',
            ]);
        }

        // Tentukan status presensi berdasarkan waktu masuk
        $status = null;

        // Logika untuk status presensi masuk
        if ($request->value === 'hadir' && now()->format('H:i') <= '08:00') {
            $status = true; // Presensi tepat waktu atau lebih awal
        } else {
            $status = false; // Presensi terlambat
        }

        // Simpan data baru ke tabel presences
        Presence::create([
            'intern_id' => $internId,
            'value' => $request->value,
            'presence_time' => $currentTime,
            'presence_date' => $currentDate,
            'status' => $status,
        ]);

        return redirect()->route('dashboard')->with(['success' => 'Absen berhasil dicatat!']);
    }
}
