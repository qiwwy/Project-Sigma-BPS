<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(): View
    {
        $schools = School::all();
        return view('master.schools', compact('schools'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'school_name' => 'required',
            'type_school' => 'required',
        ]);

        // Simpan data ke database
        $school = School::create([
            'school_name' => $request->school_name,
            'type_school' => $request->type_school,
        ]);

        return redirect()->route('schools.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();

        return redirect()->route('schools.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'school_name' => 'required',
            'type_school' => 'required',
        ]);

        $school = School::findOrFail($id);

        $school->school_name = $request->input('school_name');
        $school->type_school = $request->input('type_school');
        $school->save();

        return redirect()->route('schools.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
    }
}
