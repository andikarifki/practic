<?php

namespace App\Http\Controllers;

use App\Models\TempatBerobat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TempatBerobatController extends Controller
{
    public function index()
    {
        return Inertia::render('TempatBerobat/Index', [
            'tempats' => TempatBerobat::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('TempatBerobat/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        TempatBerobat::create($validated);

        // Ubah bagian ini agar mengarah ke route index tempat berobat
        return redirect()->route('tempat.index')->with('message', 'Tempat praktik berhasil ditambahkan!');
    }

    public function destroy(TempatBerobat $tempatBerobat)
    {
        $tempatBerobat->delete();

        return redirect()->back();
    }

    public function edit(TempatBerobat $tempatBerobat)
    {
        return Inertia::render('TempatBerobat/Edit', [
            'tempat' => $tempatBerobat,
        ]);
    }

    public function update(Request $request, TempatBerobat $tempatBerobat)
    {
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $tempatBerobat->update($validated);

        return redirect()->route('tempat.index')->with('message', 'Tempat berhasil diperbarui!');
    }
}
