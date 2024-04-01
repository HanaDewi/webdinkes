<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencapaian extends Model
{
    use HasFactory;

    protected $table = "pencapaians";

    protected $fillable = [
        'kode',
        'program',
        'indikator_kinerja',
        'tipe',
        'target',
        'realisasi_januari',
        'realisasi_februari',
        'realisasi_maret',
        'realisasi_april',
        'realisasi_mei',
        'realisasi_juni',
        'realisasi_juli',
        'realisasi_agustus',
        'realisasi_september',
        'realisasi_oktober',
        'realisasi_november',
        'realisasi_desember',
        'realisasi_akhir',
        'definisi_operasional',
        'tahun',
        'keg',
        'apbd',
        'komentar',
    ];

}