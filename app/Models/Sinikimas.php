<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinikimas extends Model
{
    use HasFactory;

    protected $table = "sinikimas";

    protected $fillable = [
        'no',
        'upaya_kesehatan',
        'kegiatan',
        'satuan',
        'target_sasaran',
        'pencapaian',
        'cakupan',
        'nilai',
        'validasi',
        'jenis_cakupan',
        'jenis_indikator',
        'jenis_subindikator',
        'tahun',
        'akun_puskesmas',
        
    ];
}
