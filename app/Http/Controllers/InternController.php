<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Interns;
use App\Models\LastDateInterns;
use Illuminate\Contracts\View\View as ViewView;

class InternController extends Controller
{
    public function index(): View
    {
        $interns = Interns::where('status', 'Active')
            ->whereNotNull('division_id')
            ->get();
        return view('master.interns', compact('interns'));
    }

    public function dispositionIntern(): View
    {
        $interns = Interns::where('status', 'Active')->whereNull('division_id')->get();
        $divisions = Division::all(); // Ambil semua data divisi
        return view('monitoring.disposition', compact('interns', 'divisions'));
    }


    public function updateDisposition(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required',
        ]);

        $intern = Interns::findOrFail($id);

        $intern->division_id = $request->input('division_id');
        $intern->save();

        return redirect()->route('monitoring.disposition.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
    }

    public function getEndDateUnique()
    {

        $interns = Interns::where('status', 'Active')->get();

        $endDateUnique = $interns->pluck('end_date')->filter();
        $endDateUniqueCounts = $endDateUnique->countBy();
        $sortedEndDateCounts = $endDateUniqueCounts->sortKeys();

        foreach ($sortedEndDateCounts as $endDate => $count) {
            LastDateInterns::updateOrCreate(
                ['end_date' => $endDate],
                ['count' => $count]
            );
        }

        return redirect()->back()->with('success', 'Tanggal Tersedia Berhasil Diperbaharui');
    }
}
