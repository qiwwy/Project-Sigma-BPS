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
        return redirect()->route('internRegister.daftar')->with(['successRegister' => 'Pendaftaran berhasil dikirim!']);
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

        $initialCapacity = $lastDate->count;
        $remainingCapacity = $initialCapacity;

        // Modifikasi query untuk memfilter data dengan accept_stat 'Accept' dan is_set false
        $acceptedRegisters = InternRegister::with('school')
            ->where('accept_stat', 'Accept')   // Data dengan status 'Accept'
            ->where('is_sent', 'not_yet')           // Data yang belum diproses (is_set false)
            ->get();

        $notSentCount = 0;
        $sentCount = 0;

        foreach ($acceptedRegisters as $acceptedRegister) {
            // Cek apakah sudah ada di dalam queue
            $exists = InternQueue::where('identity_number', $acceptedRegister->identity_number)->exists();

            if (!$exists && $remainingCapacity > 0) {
                // Masukkan data ke antrian
                InternQueue::create([
                    'identity_number' => $acceptedRegister->identity_number,
                    'name' => $acceptedRegister->name,
                    'address' => $acceptedRegister->address,
                    'school_name' => $acceptedRegister->school->school_name ?? 'No School', // Pastikan school ada
                    'phone_number' => $acceptedRegister->phone_number,
                    'email' => $acceptedRegister->email,
                    'start_date' => $acceptedRegister->start_date,
                    'end_date' => $acceptedRegister->end_date,
                    'image' => $acceptedRegister->image,
                    'last_date_id' => $lastDate->id
                ]);

                // Update field 'is_set' menjadi true
                $acceptedRegister->is_sent = 'done';
                $acceptedRegister->save();

                $sentCount++;
                $remainingCapacity--;
            } else {
                $notSentCount++;
            }
        }

        $lastDate->count = $remainingCapacity;
        $lastDate->save();

        return redirect()->route('internQueue.index')->with('successTransferedtoQueue', 'Data registrasi berhasil dipindahkan ke antrian');
    }

    public function transferRejected()
    {
        $rejectedRegisters = InternRegister::where('accept_stat', 'Reject')->get();

        foreach ($rejectedRegisters as $rejectedRegister) {
            $rejectedRegister->is_sent = true;
            $rejectedRegister->save();
        }

        return redirect()->route('internRegister.index')->with('successRemoved', 'Rejected participants removed successfully.');
    }
}
