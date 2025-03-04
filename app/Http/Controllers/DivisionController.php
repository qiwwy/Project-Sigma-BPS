<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(): View
    {
        $divisions = Division::all();
        return view('master.divisions', compact('divisions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'division_name' => [
                'required',
                'min:3',                      // Minimal 3 karakter
                'max:100',                    // Maksimal 100 karakter
                'regex:/^[A-Za-z]/',          // Harus diawali dengan huruf
            ],
        ], [
            'division_name.required' => 'Nama Divisi wajib diisi.',
            'division_name.min' => 'Nama Divisi harus memiliki minimal 3 karakter.',
            'division_name.max' => 'Nama Divisi tidak boleh lebih dari 100 karakter.',
            'division_name.regex' => 'Nama Divisi harus diawali dengan huruf.',
        ]);

        try {
            $division = Division::create([
                'division_name' => $request->division_name,
            ]);

            // Set session success message
            return redirect()->route('divisions.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            // Set session error message
            return redirect()->route('divisions.index')->with('error', 'Data Gagal Disimpan! Coba lagi.');
        }
    }

    public function showDivisionsWithInternCount()
    {
        $divisions = Division::withCount('interns')->get();

        return view('dashboard', compact('divisions'));
    }


    public function destroy($id)
    {
        try {
            $division = Division::findOrFail($id);
            $division->delete();

            return redirect()->route('divisions.index')->with(['successDelete' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Jika terjadi error (misal data tidak ditemukan)
            return redirect()->route('divisions.index')->with(['errorDelete' => 'Data Gagal Dihapus. Silakan coba lagi.']);
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'division_name' => 'required',
        ]);

        $division = Division::findOrFail($id);

        $division->division_name = $request->input('division_name');
        $division->save();

        return redirect()->route('divisions.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
    }
}
