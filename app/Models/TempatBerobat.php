<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatBerobat extends Model
{
    use HasFactory;

    // Tambahkan baris ini
    protected $fillable = [
        'nama_tempat',
        'alamat',
    ];
}
