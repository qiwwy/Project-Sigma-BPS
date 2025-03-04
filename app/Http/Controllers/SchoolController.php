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
        // Validasi input dengan aturan yang sama
        $request->validate([
            'school_name' => [
                'required',
                'min:3',                      // Minimal 3 karakter
                'max:100',                    // Maksimal 100 karakter
                'regex:/^[A-Za-z]/',          // Harus diawali dengan huruf
            ]
        ], [
            // Pesan validasi untuk 'school_name'
            'school_name.required' => 'Nama sekolah wajib diisi.',
            'school_name.min' => 'Nama sekolah harus memiliki minimal 3 karakter.',
            'school_name.max' => 'Nama sekolah tidak boleh lebih dari 100 karakter.',
            'school_name.regex' => 'Nama sekolah harus diawali dengan huruf.',
        ]);

        try {
            // Simpan data ke database
            $school = School::create([
                'school_name' => $request->school_name,
                'type_school' => $request->type_school,
            ]);

            // Set session success message
            return redirect()->route('schools.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            // Set session error message
            return redirect()->route('schools.index')->with('error', 'Data Gagal Disimpan! Coba lagi.');
        }
    }


    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();

        return redirect()->route('schools.index')->with(['successDelete' => 'Data Berhasil Dihapus!']);
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
