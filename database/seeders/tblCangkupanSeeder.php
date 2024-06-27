<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tblCangkupanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tbl_cangkupans')->insert([
            [
                'name_cangkupan' => 'UKM Esensial',
            ],
            [
                'name_cangkupan' => 'UKM Pengembangan',
            ],
            [
                'name_cangkupan' => 'Upaya Kesehatan Perorangan (UKP)',
            ],
            [
                'name_cangkupan' => 'Farmasi Dan Lab',
            ],
            [
                'name_cangkupan' => 'Manajemen Puskemas',
            ],
        ]);
    }
}
