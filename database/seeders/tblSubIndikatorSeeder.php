<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tblSubIndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_subindikators')->insert([
            [
                'name_subindikator' => 'Kesehatan Ibu dan KB',
            ],
            [
                'name_subindikator' => 'Kesehatan Anak',
            ],
            [
                'name_subindikator' => 'Penggerakan Germas',
            ],
            [
                'name_subindikator' => 'Kampanye Germas',
            ],
            [
                'name_subindikator' => 'Kampanye PHBS',
            ],
            [
                'name_subindikator' => 'Penyuluhan Program Kesehatan',
            ],
            [
                'name_subindikator' => 'Penyelenggaraan Kota Sehat',
            ],
            [
                'name_subindikator' => 'Pengawasan Kualitas Air Minum (PKAM) & Tempat Pengelolaan Pangan (TPP)',
            ],
            [
                'name_subindikator' => 'Pengawasan dan Pengendalian Tempat Fasilitas Umum (TFU) DAN Tempat Pengelolaan Pangan (TPP)',
            ],
            [
                'name_subindikator' => 'Pengawasan dan Pengendalian Penyehatan Lingkungan Pemukiman',
            ],
            [
                'name_subindikator' => 'Pembinaan Penyehatan Lingkungan Sehat',
            ],
            [
                'name_subindikator' => 'Edukasi Gizi',
            ],
            [
                'name_subindikator' => 'PELAYANAN IMUNISASI',
            ],
            [
                'name_subindikator' => 'PENGAMATAN EPIDEMIOLOGI',
            ],
            [
                'name_subindikator' => 'PTM',
            ],
            [
                'name_subindikator' => 'PEMBERANTASAN PENYAKIT',
            ],
        ]);
    }
}
