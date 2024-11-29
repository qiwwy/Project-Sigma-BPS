<?php

namespace App\Http\Controllers;

use App\Models\InternQueue;
use App\Models\Interns;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InternQueueController extends Controller
{
    public function index(): View
    {
        $internQueueGroup = InternQueue::with('lastDate')
            ->get()
            ->groupBy('last_date_id');
        return view('list_intern_queues', compact('internQueueGroup'));
    }

    public function showDetailQueue($lastDateId)
    {
        $interns = InternQueue::where('last_date_id', $lastDateId)->get();

        if ($interns->isEmpty()) {
            return redirect()->route('internQueue.index')->with('error', 'Tidak ada peserta untuk tanggal ini.');
        }

        return view('internQueue.showDetailQueue', compact('interns'));
    }

    public function transferToIntern(Request $request)
    {
        $lastDateId = $request->input('last_date_id');

        if (!$lastDateId) {
            return redirect()->route('internQueue.index')->with('error', 'Tanggal tidak ditemukan.');
        }

        $activeCount = Interns::where('status', 'Active')->count();

        if ($activeCount >= 15) {
            return redirect()->route('internQueue.index')->with('error', 'Jumlah peserta yang aktif sudah mencapai batas maksimal (15). Data tidak bisa dipindahkan.');
        }

        $internQueueGroup = InternQueue::where('last_date_id', $lastDateId)
            ->with('lastDate')
            ->get();

        if ($internQueueGroup->isEmpty()) {
            return redirect()->route('internQueue.index')->with('error', 'Tidak ada data yang ditemukan untuk tanggal tersebut.');
        }

        $transferredCount = 0;
        $failedCount = 0;

        foreach ($internQueueGroup as $intern) {
            $exists = Interns::where('identity_number', $intern->identity_number)->exists();

            if (!$exists) {
                Interns::create([
                    'identity_number' => $intern->identity_number,
                    'name' => $intern->name,
                    'address' => $intern->address,
                    'school_name' => $intern->school_name,
                    'phone_number' => $intern->phone_number,
                    'email' => $intern->email,
                    'start_date' => $intern->start_date,
                    'end_date' => $intern->end_date,
                    'image' => $intern->image,
                    'status' => 'Active'
                ]);

                $intern->delete();
                $transferredCount++;
            } else {
                $failedCount++;
            }
        }

        return redirect()->route('internQueue.index')->with('successTransfered', 'Peserta berhasil dipindahkan');
    }
}
