<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemen extends Model
{
    use HasFactory;
    protected $table = "tbl_manajemens";
    protected $fillable = [
        'indikator',
        'sub_indikator',
        'jenis_variabel',
        'nilai_0',
        'nilai_4',
        'nilai_7',
        'nilai_10',
        'nilai_hasil',
        'akun_puskesmas',
        'created_at',
        'updated_at',
        'bulan',
        'tahun',
    ];
    

}
