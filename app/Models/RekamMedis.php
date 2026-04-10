<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $fillable = [
        'pendaftaran_id',
        'pasien_id',
        'diagnosa',
        'obat',
        'catatan_dokter',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
