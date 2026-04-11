<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request; // Import Model Pasien
use Inertia\Inertia;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Pasien/Index', [
            // Menggunakan query() agar bisa ditambahkan filter kondisional
            'pasiens' => Pasien::query()
                ->when($request->search, function ($query, $search) {
                    // Logika Cerdas:
                    // Jika user mengetik 'RM-000001', kita bersihkan agar hanya mengambil angka '1'
                    $cleanSearch = ltrim(str_replace('RM-', '', $search), '0');

                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('id', $cleanSearch)
                        ->orWhere('nik', 'like', "%{$search}%"); // Tambahan: cari berdasarkan NIK juga
                })
                ->latest()
                ->get(),

            // Kirim balik inputan search ke Vue agar kolom input tidak kosong setelah loading
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        // Menampilkan halaman form tambah pasien
        return Inertia::render('Pasien/Create');
    }

    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:pasiens,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        // 2. Simpan ke database melalui Model
        Pasien::create($validated);

        // 3. Redirect kembali ke tabel pasien dengan pesan sukses
        return redirect()->route('pasien.index')->with('message', 'Data pasien berhasil ditambahkan!');
    }

    public function destroy(Pasien $pasien)
    {
        // Hapus data dari database
        $pasien->delete();

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('pasien.index')->with('message', 'Data pasien berhasil dihapus.');
    }

    public function edit(Pasien $pasien)
    {
        // Kita perlu memformat tanggal_lahir ke Y-m-d agar input HTML type="date" bisa membacanya
        return Inertia::render('Pasien/Edit', [
            'pasien' => [
                'id' => $pasien->id,
                'nik' => $pasien->nik,
                'nama' => $pasien->nama,
                'jenis_kelamin' => $pasien->jenis_kelamin,
                'nomor_hp' => $pasien->nomor_hp,
                'alamat' => $pasien->alamat,
                'tanggal_lahir' => $pasien->tanggal_lahir?->format('Y-m-d'), // PENTING
            ],
        ]);
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:pasiens,nik,'.$pasien->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        // Update data menggunakan hasil validasi
        $pasien->update($validated);

        return redirect()->route('pasien.index')->with('message', 'Data pasien berhasil diperbarui!');
    }

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);

        return Inertia::render('Pasien/Show', [
            'pasien' => [
                'id' => $pasien->id,
                'nama' => $pasien->nama,
                'nik' => $pasien->nik,
                'nomor_hp' => $pasien->nomor_hp,
                'alamat' => $pasien->alamat,
                'jenis_kelamin' => $pasien->jenis_kelamin,
                'tanggal_lahir' => $pasien->tanggal_lahir?->format('d F Y') ?? '-',
                'dibuat_pada' => $pasien->created_at?->format('d M Y') ?? '-',
            ],
        ]);
    }
}
