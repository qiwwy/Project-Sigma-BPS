<?php

namespace App\Http\Controllers;

use App\Models\InternQueue;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InternQueueController extends Controller
{
    // public function index(): View
    // {
    //     $internsQueues = InternQueue::all();
    //     return view('list_intern_queues', compact('internsQueues'));
    // }
    public function index(): View
    {
        $internQueueGroup = InternQueue::with('lastDate') // Misalnya, jika Anda menggunakan relasi untuk mengambil 'last_date_interns'
            ->get()
            ->groupBy('last_date_id');  // Mengelompokkan berdasarkan 'last_date_id'
        return view('list_intern_queues', compact('internQueueGroup'));
    }
}
