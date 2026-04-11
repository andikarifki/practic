<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\RekamMedis;
use App\Models\TempatBerobat; // 1. IMPORT MODEL REKAM MEDIS
use Illuminate\Http\Request;
use Inertia\Inertia;

class PendaftaranController extends Controller
{
    public function index()
    {
        return Inertia::render('Pendaftaran/Index', [
            // Mengambil data pendaftaran beserta relasi pasien dan tempatnya
            'pendaftarans' => Pendaftaran::with(['pasien', 'tempat_berobat'])->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Pendaftaran/Create', [
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
            'keluhan' => 'nullable|string',
        ]);

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')->with('message', 'Pendaftaran berhasil dibuat!');
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        // Memuat relasi rekam_medis yang baru saja kita buat di model
        $pendaftaran->load('rekam_medis');

        return Inertia::render('Pendaftaran/Edit', [
            'pendaftaran' => $pendaftaran,
            'pasiens' => Pasien::all(),
            'tempats' => TempatBerobat::all(),
        ]);
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        // 2. VALIDASI DATA (Termasuk data rekam medis jika status 'Selesai')
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'tempat_berobat_id' => 'required|exists:tempat_berobats,id',
            'tanggal_periksa' => 'required|date',
            'status' => 'required|string',
            'keluhan' => 'nullable|string',

            // Tambahkan validasi diagnosa & obat jika status diubah ke Selesai
            'diagnosa' => 'required_if:status,Selesai',
            'obat' => 'required_if:status,Selesai',
            'catatan_dokter' => 'nullable|string',
        ]);

        // 3. UPDATE DATA PENDAFTARAN
        $pendaftaran->update($validated);

        // 4. LOGIKA PEMINDAHAN KE REKAM MEDIS
        if ($request->status === 'Selesai') {
            RekamMedis::updateOrCreate(
                ['pendaftaran_id' => $pendaftaran->id], // Cari berdasarkan ID pendaftaran
                [
                    'pasien_id' => $pendaftaran->pasien_id,
                    'diagnosa' => $request->diagnosa,
                    'obat' => $request->obat,
                    'catatan_dokter' => $request->catatan_dokter,
                ]
            );
        }

        return redirect()->route('pendaftaran.index')->with('message', 'Data berhasil diperbarui!');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()->back()->with('message', 'Data berhasil dihapus!');
    }

    public function show($id)
    {
        // Mengambil pendaftaran beserta data pasien dan tempat berobat
        $pendaftaran = Pendaftaran::with(['pasien', 'tempat_berobat'])->findOrFail($id);

        return Inertia::render('Pendaftaran/Show', [
            'pendaftaran' => [
                'id' => $pendaftaran->id,
                'tanggal' => $pendaftaran->tanggal_periksa,
                'status' => $pendaftaran->status,
                'keluhan' => $pendaftaran->keluhan,
                'pasien' => [
                    'nama' => $pendaftaran->pasien->nama,
                    'nik' => $pendaftaran->pasien->nik,
                    'nomor_hp' => $pendaftaran->pasien->nomor_hp,
                    'alamat' => $pendaftaran->pasien->alamat,
                ],
                'tempat' => $pendaftaran->tempat_berobat->nama_tempat,
            ],
        ]);
    }
}
