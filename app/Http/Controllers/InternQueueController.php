<?php

namespace App\Http\Controllers;

use App\Models\InternQueue;
use App\Models\Interns;
use App\Models\LastDateInterns;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InternQueueController extends Controller
{
    public function index(): View
    {
        // Ambil data antrian magang dan group by last_date_id
        $internQueueGroup = InternQueue::with('lastDate')
            ->get()
            ->groupBy('last_date_id');

        // Hitung total peserta magang yang berstatus aktif
        $totalActiveInterns = Interns::where('status', 'active')->count();

        // Kirim data ke view
        return view('register.register_queue', compact('internQueueGroup', 'totalActiveInterns'));
    }

    public function showDetailQueue($lastDateId = null)
    {
        // Ambil data berdasarkan last_date_id, atau semua data jika last_date_id null
        $interns = $lastDateId
            ? InternQueue::where('last_date_id', $lastDateId)->get()
            : InternQueue::whereNull('last_date_id')->get();

        if ($interns->isEmpty()) {
            return redirect()->route('internQueue.index')->with(
                'error',
                $lastDateId
                ? 'Tidak ada peserta untuk tanggal ini.'
                : 'Tidak ada peserta dengan tanggal yang belum ditentukan.'
            );
        }

        return view('register.register_queue_detail', compact('interns', 'lastDateId'));
    }

    public function destroy($id)
    {
        // Temukan antrian berdasarkan id
        $internQueue = InternQueue::find($id);

        // Cek apakah data ditemukan
        if (!$internQueue) {
            return redirect()->route('internQueue.index')->with('error', 'Antrian magang tidak ditemukan.');
        }

        // Cari tanggal terkait (last_date)
        $lastDate = LastDateInterns::find($internQueue->last_date_id);

        // Hapus data dari antrian
        $internQueue->delete();

        // Jika tanggal terkait ditemukan, kurangi count_used
        if ($lastDate) {
            $lastDate->count_used = max(0, $lastDate->count_used - 1); // Pastikan tidak negatif
            $lastDate->save();
        }

        return redirect()->route('internQueue.index')->with('successDelete', 'Antrian magang berhasil dihapus dan kapasitas diperbarui.');
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
                // Pindahkan data intern
                $newIntern = Interns::create([
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

                // Membuat user terkait setelah intern dipindahkan
                User::create([
                    'interns_id' => $newIntern->id,  // Menghubungkan user dengan intern
                    'username' => $newIntern->identity_number,  // Gunakan identity_number sebagai username
                    'password' => Hash::make($newIntern->identity_number),  // Enkripsi password dengan identity_number
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Hapus data dari queue setelah dipindahkan
                $intern->delete();

                $transferredCount++;
            } else {
                $failedCount++;
            }
        }
        return redirect()->route('monitoring.disposition.index')->with('successTransferedtoDisposition', 'Peserta berhasil ditambahkan, Harap tetapkan divisinya.');
    }
}
