<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'tempat_berobat_id',
        'tanggal_periksa',
        'keluhan',
        'status',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function tempat_berobat()
    {
        return $this->belongsTo(TempatBerobat::class);
    }
}
