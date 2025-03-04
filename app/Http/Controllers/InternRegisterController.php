<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InternRegisterMail;
use App\Models\InternQueue;
use App\Models\InternRegister;
use App\Models\LastDateInterns;
use Illuminate\Http\RedirectResponse;

class InternRegisterController extends Controller
{
    public function index(): View
    {
        $internRegisters = InternRegister::with('school')->where('is_sent', 'not_yet')->get();

        foreach ($internRegisters as $item) {
            $closestDate = LastDateInterns::where('end_date', '<', $item->start_date)
                ->orderBy('end_date', 'desc')
                ->first();

            if ($closestDate) {
                $item->closest_date = $closestDate->end_date;
            } else {
                $item->closest_date = null;
            }

            $item->save();
        }

        // Mengurutkan berdasarkan `closest_date` yang paling kecil
        $internRegisters = $internRegisters->sortBy('closest_date');

        return view('register.register_list', compact('internRegisters'));
    }

    public function showByToken(string $token): View
    {
        $internRegister = InternRegister::where('token', $token)->first();

        if (!$internRegister) {
            abort(404, 'Pendaftaran tidak ditemukan.');
        }

        return view('register.register_by_token', compact('internRegister'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'school_id' => 'required|exists:schools,id', // Validasi foreign key
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'cover_letter' => 'required|file',
        ], [
            'identity_number.required' => 'Nomor identitas wajib diisi.',
            'name.required' => 'Nama lengkap harus diisi.',
            'school_id.required' => 'ID sekolah wajib dipilih.',
            'school_id.exists' => 'ID sekolah yang Anda pilih tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email yang Anda masukkan tidak valid.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.required' => 'Tanggal akhir wajib diisi.',
            'end_date.date' => 'Tanggal akhir harus berupa tanggal yang valid.',
            'end_date.after_or_equal' => 'Tanggal akhir harus lebih besar atau sama dengan tanggal mulai.',
            'cover_letter.required' => 'Surat lamaran wajib diunggah.',
            'cover_letter.file' => 'File surat lamaran harus berupa file.',
        ]);

        // Simpan file cover letter
        $cover_letter = $request->file('cover_letter');
        $cover_letter->storeAs('cover_letter', $cover_letter->hashName());

        // Generate token unik
        $token = Str::random(32);

        // Simpan data ke database
        $internRegister = InternRegister::create([
            'identity_number' => $request->identity_number,
            'name' => $request->name,
            'school_id' => $request->school_id, // Simpan ID sekolah
            'email' => $request->email,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cover_letter' => $cover_letter->hashName(),
            'token' => $token,
        ]);

        Mail::to($internRegister->email)->send(new InternRegisterMail($internRegister));
        return redirect()->route('internRegister.daftar')->with(['successRegister' => 'Silahkan cek email anda untuk pemantauan status pendaftaran!']);
    }

    public function updateStatus(Request $request)
    {
        $internRegister = InternRegister::find($request->id);
        $stateNow = $internRegister->accept_stat;

        if ($stateNow === "Process") {
            $internRegister->accept_stat = "Accept";
        } elseif ($stateNow === "Accept") {
            $internRegister->accept_stat = "Reject";
        } else {
            $internRegister->accept_stat = "Process";
        }

        $internRegister->save();

        return response()->json(['status' => $internRegister->accept_stat]);
    }

    public function transferAccepted(Request $request)
    {
        $lastDateId = $request->input('lastDate_id');
        $lastDate = LastDateInterns::find($lastDateId);

        $totalCount = LastDateInterns::sum('count');
        $totalCountUsed = LastDateInterns::sum('count_used');
        $rumus = $totalCount - $totalCountUsed; // Kapasitas yang tersisa

        // Periksa kondisi jika lastDate null dan $rumus berisi angka (tidak kosong)
        if (is_null($lastDate) && $rumus > 0) {
            return redirect()->route('internRegister.index')->with(
                'errorTransfer',
                'Transfer gagal! Anda harus memilih tanggal terlebih dahulu.'
            );
        }

        // Kapasitas awal
        $initialCapacity = $lastDate ? $lastDate->count : 0;
        $remainingCapacity = $lastDate ? ($initialCapacity - $lastDate->count_used) : (15 - $totalCount);

        // Ambil data registrasi yang diterima
        $acceptedRegisters = InternRegister::with('school')
            ->where('accept_stat', 'Accept')
            ->where('is_sent', 'not_yet')
            ->get();

        // Periksa apakah ada data dengan status `Accept` dan kapasitas > 0
        if ($acceptedRegisters->isEmpty() || $remainingCapacity <= 0) {
            return redirect()->route('internRegister.index')->with(
                'errorTransfer',
                $remainingCapacity <= 0
                ? 'Transfer gagal! Kapasitas antrian sudah penuh.'
                : 'Transfer gagal! Harap kirim data dengan status "Accept".'
            );
        }

        $notSentCount = 0;
        $sentCount = 0;

        // Proses data untuk transfer
        foreach ($acceptedRegisters as $acceptedRegister) {
            $exists = InternQueue::where('identity_number', $acceptedRegister->identity_number)->exists();

            if (!$exists && $remainingCapacity > 0) {
                InternQueue::create([
                    'identity_number' => $acceptedRegister->identity_number,
                    'name' => $acceptedRegister->name,
                    'address' => $acceptedRegister->address,
                    'school_name' => $acceptedRegister->school->school_name ?? 'No School',
                    'phone_number' => $acceptedRegister->phone_number,
                    'email' => $acceptedRegister->email,
                    'start_date' => $acceptedRegister->start_date,
                    'end_date' => $acceptedRegister->end_date,
                    'image' => $acceptedRegister->image,
                    'last_date_id' => $lastDate ? $lastDate->id : null,
                ]);

                // Update status data
                $acceptedRegister->is_sent = 'done';
                $acceptedRegister->save();

                $sentCount++;
                $remainingCapacity--;
            } else {
                $notSentCount++;
            }
        }

        // Jika ada lastDate, update kapasitasnya
        if ($lastDate) {
            $lastDate->count_used += $sentCount;
            $lastDate->save();
        }

        // Redirect jika transfer berhasil
        return redirect()->route('internQueue.index')->with(
            'successTransferedtoQueue',
            'Data registrasi berhasil dipindahkan ke antrian.'
        );
    }

    public function transferRejected()
    {
        $rejectedRegisters = InternRegister::where('accept_stat', 'Reject')->get();

        foreach ($rejectedRegisters as $rejectedRegister) {
            $rejectedRegister->is_sent = 'done';
            $rejectedRegister->save();
        }

        return redirect()->route('internRegister.index')->with('successRemoved', 'Rejected participants removed successfully.');
    }
}
