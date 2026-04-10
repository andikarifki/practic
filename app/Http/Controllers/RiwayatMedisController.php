<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Inertia\Inertia;

class RiwayatMedisController extends Controller
{
    public function index()
    {
        return Inertia::render('Riwayat/Index', [
            'riwayats' => RekamMedis::with(['pasien', 'pendaftaran.tempat_berobat'])
                ->latest()
                ->paginate(10)
                ->through(fn ($rm) => [
                    'id' => $rm->id,
                    'tanggal' => $rm->created_at->format('d-m-Y'),
                    'nama_pasien' => $rm->pasien->nama,
                    'tempat' => $rm->pendaftaran->tempat_berobat->nama_tempat ?? '-',
                    'diagnosa' => $rm->diagnosa,
                    'obat' => $rm->obat,
                ]),
        ]);
    }

    /**
     * Menampilkan detail satu rekam medis (untuk view/cetak)
     */
    public function show($id)
    {
        $rm = RekamMedis::with(['pasien', 'pendaftaran.tempat_berobat'])->findOrFail($id);

        return Inertia::render('Riwayat/Show', [
            'riwayat' => [
                'id' => $rm->id,
                'tanggal_lengkap' => $rm->created_at->format('d F Y'),
                'pasien' => $rm->pasien,
                'lokasi' => $rm->pendaftaran->tempat_berobat->nama_tempat,
                'keluhan_awal' => $rm->pendaftaran->keluhan, // Tetap bisa panggil keluhan awal
                'diagnosa' => $rm->diagnosa,
                'obat' => $rm->obat,
                'catatan' => $rm->catatan_dokter,
            ],
        ]);
    }
}
