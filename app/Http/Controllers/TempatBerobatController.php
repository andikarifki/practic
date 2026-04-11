<?php

namespace App\Http\Controllers;

use App\Models\TempatBerobat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TempatBerobatController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('TempatBerobat/Index', [
            'tempats' => TempatBerobat::query()
                // Filter pencarian berdasarkan nama_tempat saja
                ->when($request->search, function ($query, $search) {
                    $query->where('nama_tempat', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(10)
                ->withQueryString(), // Menjaga query parameter saat pindah halaman
            'filters' => $request->only(['search']),
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
            // Alamat dihapus dari sini
        ]);

        TempatBerobat::create($validated);

        return redirect()->route('tempat.index')->with('message', 'Data berhasil ditambah');
    }

    public function edit(TempatBerobat $tempatBerobat)
    {
        return Inertia::render('TempatBerobat/Edit', [
            'tempat' => [
                'id' => $tempatBerobat->id,
                'nama_tempat' => $tempatBerobat->nama_tempat,
                // Alamat tidak dikirim ke view Edit
            ],
        ]);
    }

    public function update(Request $request, TempatBerobat $tempatBerobat)
    {
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:255',
            // Alamat dihapus dari sini
        ]);

        $tempatBerobat->update($validated);

        return redirect()->route('tempat.index')->with('message', 'Data berhasil diubah');
    }

    public function destroy(TempatBerobat $tempatBerobat)
    {
        $tempatBerobat->delete();

        return redirect()->back();
    }
}
