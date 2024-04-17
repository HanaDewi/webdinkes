<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $csvFile = fopen(base_path("database/data/data_subkegiatan.csv"), "r");
  
    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
        if (!$firstline) {
            DB::table('pencapaians')->insert([
                "kode" => $data['0'],
                "program" => $data['1'],
                "indikator_kinerja" => $data['2'],
                "target" => $data['4'],
                "tahun" => $data['19'],
                "keg" => $data['20'],
                "apbd" => $data['21'],
            ]);    
        }
        $firstline = false;
    }

    fclose($csvFile);
    }
}
