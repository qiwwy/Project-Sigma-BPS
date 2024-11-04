<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Interns;


class InternController extends Controller
{
    public function index(): View
    {
        $interns = Interns::all();
        return view('list_interns', compact('interns'));
    }
}
