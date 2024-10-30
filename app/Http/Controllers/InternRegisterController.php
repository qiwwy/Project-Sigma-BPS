<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\InternRegister;
use Illuminate\Http\RedirectResponse;

class InternRegisterController extends Controller
{
    public function index(): View
    {
        $internRegisters = InternRegister::all();
        return view('list_intern_registers', compact('internRegisters'));
    }

    public function create(): View{
        return view('intern_register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'identity_number' => 'required',
            'name' => 'required',
            'address' => 'required',
            'school_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'cover_letter' => 'required|file',
            'image' => 'required|file',
        ]);

        $cover_letter = $request->file('cover_letter');
        $cover_letter->storeAs('cover_letter', $cover_letter->hashName());

        $image = $request->file('image');
        $image->storeAs('image', $image->hashName());

        $token= Str::random(32);

        InternRegister::create([
            'identity_number' => $request->identity_number,
            'name' => $request->name,
            'address' => $request->address,
            'school_name' => $request->school_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cover_letter' => $cover_letter->hashName(),
            'image' => $image->hashName(),
            'token'=> $token
        ]);

        return redirect()->route('internRegister.create')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
