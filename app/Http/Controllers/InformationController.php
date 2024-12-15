<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Information;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(): View
    {
        $divisions = Division::all();
        $informations = Information::all();
        return view('monitoring.information', compact('informations', 'divisions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'target' => 'required',
            'division_id' => 'required_if:target,division',
            'document' => 'nullable|file',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Handle document upload
        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        }

        // Prepare division_id
        $divisionId = $request->target === 'division' ? $request->division_id : null;

        // Save information
        Information::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'target' => $request->target,
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
}
