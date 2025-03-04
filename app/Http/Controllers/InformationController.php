<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Information;
use App\Models\TaskSubmission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(): View
    {
        $user = session('intern');
        $divisions = Division::all();

        if ($user->role === 'mentor') {

            $informations = Information::where('division_id', $user->division_id)->get();
        } elseif ($user->role === 'intern') {

            $informations = Information::where(function ($query) use ($user) {
                $query->where('division_id', $user->division_id)
                    ->orWhereNull('division_id');
            })->get();
        } else {

            $informations = Information::all();
        }

        return view('monitoring.information', compact('informations', 'divisions'));
    }

    public function show($id)
    {
        // Menemukan informasi berdasarkan ID
        $information = Information::findOrFail($id);

        // Mengirim data informasi ke view 'monitoring.information.show'
        return view('monitoring.information_show', compact('information'));
    }
    public function store(Request $request): RedirectResponse
    {
        // Tentukan apakah pengguna adalah ketua divisi
        $isDivisionHead = session('intern')->role === 'mentor'; // Ketua divisi ditentukan oleh role 'mentor'
        $divisionId = $isDivisionHead ? session('intern')->division_id : null;

        // Validasi input
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'target' => $isDivisionHead ? 'nullable' : 'required', // Ketua divisi tidak perlu memilih target
            'division_id' => $isDivisionHead ? 'nullable' : 'required_if:target,division',
            'document' => 'nullable|file',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($isDivisionHead && !$divisionId) {
            return redirect()->back()->withErrors(['error' => 'Division ID tidak ditemukan dalam session.']);
        }

        // Handle document upload
        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        }

        // Tetapkan target dan division_id
        $target = $isDivisionHead ? 'division' : $request->target;
        $divisionId = $isDivisionHead ? $divisionId : ($request->target === 'division' ? $request->division_id : null);

        // Simpan informasi
        Information::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'target' => $target,
            'division_id' => $divisionId,
            'document' => $documentPath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('monitoring.information.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();

        return redirect()->route('monitoring.information.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function edit($id): View
    {
        $information = Information::findOrFail($id);
        $divisions = Division::all();
        return view('monitoring.edit-information', compact('information', 'divisions'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:event,task,info',
            'target' => 'required|in:all,division',
            'division_id' => 'nullable|exists:divisions,id|required_if:target,division', // Division ID boleh null jika target 'all', wajib jika target 'division'
            'document' => 'nullable|file|mimes:pdf,doc,docx',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $information = Information::findOrFail($id);

        $information->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'target' => $request->target,
            'division_id' => $request->target === 'division' ? $request->division_id : null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if ($request->hasFile('document')) {
            $filePath = $request->file('document')->store('documents');
            $information->document = $filePath;
            $information->save();
        }

        return redirect()->route('monitoring.information.index')->with(['success' => 'Informasi Berhasil Diperbaharui!']);
    }

    public function showSubmissionsByTask($taskId): View
    {
        $informations = Information::with('submissions')->findOrFail($taskId);

        return view('monitoring.submissions_by_task', compact('informations'));
    }

    public function downloadSubmission(TaskSubmission $taskSubmission)
    {
        $filePath = storage_path('app/public/' . $taskSubmission->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath);
    }
}
