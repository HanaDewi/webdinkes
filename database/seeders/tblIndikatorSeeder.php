<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tblIndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_indikators')->insert([
            [
                'name_indikator' => 'KIA dan KB',
            ],
            [
                'name_indikator' => 'Promosi Kesehatan',
            ],
            [
                'name_indikator' => 'Kesehatan Lingkungan',
            ],
            [
                'name_indikator' => 'Gizi dan Pemberdayaan Masyarakat',
            ],
            [
                'name_indikator' => 'Pencengahan dan Pengendalian Penyakit',
            ],
            [
                'name_indikator' => 'Pelayanan Perkesmas',
            ],
        ]);
    }
}
