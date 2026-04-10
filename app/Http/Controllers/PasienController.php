<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request; // Import Model Pasien
use Inertia\Inertia;

class PasienController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data pasien dari database
        $pasiens = Pasien::all();

        // 2. Kirim data ke file Vue (Inertia)
        return Inertia::render('Pasien/Index', [
            'pasiens' => $pasiens,
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
        return Inertia::render('Pasien/Edit', [
            'pasien' => $pasien,
        ]);
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:pasiens,nik,'.$pasien->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $pasien->update($validated);

        return redirect()->route('pasien.index')->with('message', 'Data pasien berhasil diperbarui!');
    }
}
