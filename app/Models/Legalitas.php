<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legalitas extends Model
{
    use HasFactory;

    protected $table = 'legalitas';

    protected $fillable = [
        'data_id',
        'nomor',
        'uang_masuk',
        'tgl_masuk',
        'uang_keluar',
        'tgl_keluar',
    ];

    // Relasi ke model Data
    public function data()
    {
        return $this->belongsTo(Data::class, 'data_id');
    }
}
