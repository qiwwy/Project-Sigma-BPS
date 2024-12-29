<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class TaskSubmissionController extends Controller
{
    public function index(): View
    {
        $internSession = session('intern');
        $internId = $internSession->id;
        $divisionId = $internSession->division_id;

        // Ambil semua information_id yang sudah dikumpulkan
        $submittedInformationIds = TaskSubmission::where('intern_id', $internId)
            ->pluck('information_id')
            ->toArray();

        // Ambil semua informasi yang belum dikumpulkan, sesuai divisi atau untuk semua peserta
        $informations = Information::where(function ($query) use ($divisionId) {
            $query->where('division_id', $divisionId)
                ->orWhereNull('division_id');
        })
            ->whereNotIn('id', $submittedInformationIds)
            ->get();

        // Ambil semua tugas yang telah dikumpulkan oleh pengguna
        $taskSubmission = TaskSubmission::where('intern_id', $internId)->get();

        return view('monitoring.submission', compact('taskSubmission', 'informations'));
    }

    public function store(Request $request)
    {
        $internSession = session('intern');
        $internId = $internSession->id;

        $request->validate([
            'information_id' => 'required|exists:informations,id',
            'file_path' => 'required|file',
            'note' => 'nullable|string',
        ]);

        TaskSubmission::create([
            'intern_id' => $internId,
            'information_id' => $request->information_id,
            'file_path' => $request->file('file_path')->store('submissions', 'public'),
            'note' => $request->note
        ]);

        return redirect()->route('monitoring.submission.index')->with('success', 'Tugas Berhasil Dikumpulkan!.');
    }
}
