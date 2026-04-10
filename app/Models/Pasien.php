<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'nomor_hp',
        'jenis_kelamin',
        'tanggal_lahir',
    ];
}
