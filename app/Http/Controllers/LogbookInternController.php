<?php

namespace App\Http\Controllers;

use App\Models\LogbookIntern;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LogbookInternController extends Controller
{

    public function index(): View
    {
        $logbookInterns = LogbookIntern::all();

        return view('list_logbook_intern', compact('logbookInterns'));
    }

    public function getLogbookByIntern(): View
    {
        $logbookInterns = LogbookIntern::with('intern')
            ->get()
            ->groupBy(function ($logbook) {
                return $logbook->intern->name;
            });

        $logbookCounts = $logbookInterns->map(function ($group) {

            $totalLogbookCount = $group->count();

            $filledJobDescriptionCount = $group->filter(function ($logbook) {
                return !is_null($logbook->job_description);
            })->count();

            $filledTitleCount = $group->filter(function ($logbook) {
                return !is_null($logbook->title);
            })->count();

            $filledCompletionStatCount = $group->filter(function ($logbook) {
                return !is_null($logbook->completion_stat);
            })->count();

            $filledProcessingTimeCount = $group->filter(function ($logbook) {
                return !is_null($logbook->processing_time);
            })->count();

            $filledDivisiCount = $group->filter(function ($logbook) {
                return !is_null($logbook->divisi);
            })->count();

            $filledLogbookCount = min($filledJobDescriptionCount, $filledCompletionStatCount, $filledTitleCount, $filledProcessingTimeCount, $filledDivisiCount);

            return [
                'name' => $group->first()->intern->name,
                'school_name' => $group->first()->intern->school_name,
                'total_logbook_count' => $totalLogbookCount,
                'filled_logbook_count' => $filledLogbookCount,
                'intern_id' => $group->first()->intern_id
            ];
        });

        return view('logbook_interns', compact('logbookCounts'));
    }

    public function showDetailLogbook($internId)
    {
        $logbookInterns = LogbookIntern::where('intern_id', $internId)->get();
        if ($logbookInterns->isEmpty()) {
            return redirect()->route('logbookIntern.index')->with('error', 'Tidak ada peserta untuk logbook ini.');
        }

        return view('detailLogbook', compact('logbookInterns', 'internId'));
    }
}
