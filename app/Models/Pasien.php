<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // HARUS ADA INI

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'nomor_hp',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Membuat No RM otomatis dari ID
     * Contoh: ID 1 menjadi RM-000001
     */
    protected function noRm(): Attribute
    {
        return Attribute::make(
            get: fn () => 'RM-'.str_pad($this->id, 6, '0', STR_PAD_LEFT),
        );
    }

    /**
     * Daftarkan no_rm agar muncul di JSON (Inertia/Vue)
     */
    protected $appends = ['no_rm'];

    // Relasi ke Pendaftaran (Opsional, tapi berguna)
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
