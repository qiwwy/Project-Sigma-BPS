<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InternRegisterMail;
use App\Models\InternQueue;
use App\Models\InternRegister;
use App\Models\Interns;
use App\Models\LastDateInterns;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail as FacadesMail;

class InternRegisterController extends Controller
{
    public function index(): View
    {
        $internRegisters = InternRegister::where('is_sent', false)->get();

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

        return view('list_intern_registers', compact('internRegisters'));
    }

    public function showByToken(string $token): View
    {
        $internRegister = InternRegister::where('token', $token)->first();

        if (!$internRegister) {
            abort(404, 'Pendaftaran tidak ditemukan.');
        }

        return view('intern_register_byToken', compact('internRegister'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'address' => 'required',
            'school_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'cover_letter' => 'required|file',
            'image' => 'required|file',
        ]);

        $cover_letter = $request->file('cover_letter');
        $cover_letter->storeAs('cover_letter', $cover_letter->hashName());

        $image = $request->file('image');
        $image->storeAs('image', $image->hashName());

        $token = Str::random(32);

        $internRegister = InternRegister::create([
            'identity_number' => $request->identity_number,
            'name' => $request->name,
            'address' => $request->address,
            'school_name' => $request->school_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cover_letter' => $cover_letter->hashName(),
            'image' => $image->hashName(),
            'token' => $token
        ]);

        Mail::to($internRegister->email)->send(new InternRegisterMail($internRegister));
        return redirect()->route('internRegister.daftar')->with(['success' => 'Data Berhasil Disimpan!']);
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

        $acceptedRegisters = InternRegister::where('accept_stat', 'Accept')->get();
        $notSentCount = 0;
        $sentCount = 0;

        foreach ($acceptedRegisters as $acceptedRegister) {

            $exists = InternQueue::where('identity_number', $acceptedRegister->identity_number)->exists();

            if (!$exists && $remainingCapacity > 0) {
                InternQueue::create([
                    'identity_number' => $acceptedRegister->identity_number,
                    'name' => $acceptedRegister->name,
                    'address' => $acceptedRegister->address,
                    'school_name' => $acceptedRegister->school_name,
                    'phone_number' => $acceptedRegister->phone_number,
                    'email' => $acceptedRegister->email,
                    'start_date' => $acceptedRegister->start_date,
                    'end_date' => $acceptedRegister->end_date,
                    'image' => $acceptedRegister->image,
                    'last_date_id' => $lastDate->id
                ]);

                $acceptedRegister->is_sent = true;
                $acceptedRegister->save();

                $sentCount++;
                $remainingCapacity--;
            } else {

                $notSentCount++;
            }
        }
        $lastDate->count = $remainingCapacity;
        $lastDate->save();

        return redirect()->route('internQueue.index')->with('successTransfered', 'Transfered participants successfully');
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
