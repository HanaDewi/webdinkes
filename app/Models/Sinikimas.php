<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinikimas extends Model
{
    use HasFactory;

    protected $table = "sinikimas";

    protected $fillable = [

        'upaya_kesehatan',
        'kegiatan',
        'satuan',
        'target_1',
        'target_2',
        'target_persen',
        'target_des',
        'pencapaian',
        'cakupan',
        'nilai',
        'jenis_cakupan',
        'jenis_indikator',
        'jenis_subindikator',
        'tahun',
        'akun_puskesmas',
        
    ];
}
