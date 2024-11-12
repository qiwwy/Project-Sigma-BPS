<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Interns;
use App\Models\LastDateInterns;

class InternController extends Controller
{
    public function index(): View
    {
        $interns = Interns::all();
        return view('list_interns', compact('interns'));
    }

    public function getEndDateUnique()
    {
        $interns = Interns::all();
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
