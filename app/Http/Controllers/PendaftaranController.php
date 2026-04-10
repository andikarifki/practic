<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\TempatBerobat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PendaftaranController extends Controller
{
    public function index()
    {
        return Inertia::render('Pendaftaran/Index', [
            // Kita ambil data pendaftaran beserta relasi pasien dan tempatnya
            'pendaftarans' => Pendaftaran::with(['pasien', 'tempat_berobat'])->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Pendaftaran/Create', [
            // Kita kirim data pasien dan tempat untuk isi dropdown di form
            'pasiens' => Pasien::select('id', 'nama')->get(),
            'tempats' => TempatBerobat::select('id', 'nama_tempat')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'tempat_berobat_id' => 'required|exists:tempat_berobats,id',
            'tanggal_periksa' => 'required|date',
            'status' => 'required|string',
            'keluhan' => 'nullable|string', // <--- TAMBAHKAN BARIS INI
        ]);

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')->with('message', 'Pendaftaran berhasil dibuat!');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()->back();
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        return Inertia::render('Pendaftaran/Edit', [
            'pendaftaran' => $pendaftaran,
            'pasiens' => Pasien::select('id', 'nama')->get(),
            'tempats' => TempatBerobat::select('id', 'nama_tempat')->get(),
        ]);
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'tempat_berobat_id' => 'required|exists:tempat_berobats,id',
            'tanggal_periksa' => 'required|date',
            'status' => 'required|string',
            'keluhan' => 'nullable|string',
        ]);

        $pendaftaran->update($validated);

        return redirect()->route('pendaftaran.index')->with('message', 'Data berhasil diperbarui!');
    }
}
