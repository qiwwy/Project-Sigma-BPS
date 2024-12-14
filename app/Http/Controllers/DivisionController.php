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
            'division_name' => 'required',
        ]);

        $division = Division::create([
            'division_name' => $request->division_name,
        ]);

        return redirect()->route('divisions.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id)
    {
        $division = Division::findOrFail($id);
        $division->delete();

        return redirect()->route('divisions.index')->with(['success' => 'Data Berhasil Dihapus!']);
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
