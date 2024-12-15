<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(): View
    {
        $presences = Presence::all();
        return view('presence.presences', compact('presences'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required',
        ]);

        $userId = session('intern')->id; // Ambil user ID dari session
        $currentDate = now()->toDateString(); // Tanggal saat ini
        $type = $request->type; // Tipe kehadiran (masuk/pulang)

        // Cek apakah sudah ada data dengan user_id, tanggal, dan tipe yang sama
        $existingPresence = Presence::where('user_id', $userId)
            ->where('presence_date', $currentDate)
            ->where('type', $type)
            ->first();

        if ($existingPresence) {
            // Jika sudah ada, kembalikan dengan pesan error
            return redirect()->route('dashboard')->withErrors([
                'error' => 'Anda sudah mencatat kehadiran untuk tipe ini pada hari ini.',
            ]);
        }

        // Cek jika absensi masuk belum ada, dan pastikan pulang baru bisa dicatat setelah masuk
        if ($type === 'pulang') {
            $existingMasuk = Presence::where('user_id', $userId)
                ->where('presence_date', $currentDate)
                ->where('type', 'masuk')
                ->first();

            if (!$existingMasuk) {
                return redirect()->route('dashboard')->withErrors([
                    'error' => 'Anda harus melakukan absen masuk terlebih dahulu sebelum absen pulang.',
                ]);
            }
        }

        // Tentukan waktu dan status
        $currentTime = now()->toTimeString();
        $status = null;

        // Logika untuk status presensi masuk
        if ($type === 'masuk' && now()->format('H:i') <= '08:00') {
            $status = true; // Status masuk jika sebelum jam 08:00
        } elseif ($type === 'masuk') {
            $status = false; // Status masuk jika setelah jam 08:00
        }

        // Jika absen pulang, set status menjadi true
        if ($type === 'pulang') {
            $status = true; // Status pulang selalu true
        }

        // Simpan data baru ke tabel presences
        Presence::create([
            'user_id' => $userId,
            'type' => $type,
            'presence_time' => $currentTime,
            'presence_date' => $currentDate,
            'status' => $status,
        ]);

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
