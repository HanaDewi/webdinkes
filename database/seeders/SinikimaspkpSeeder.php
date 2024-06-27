<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SinikimasPkpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data yang di-generate dengan loop for
        $dataTemplate = [
            'upaya_kesehatan' => 'a',
            'kegiatan' => 'Cakupan K1',
            'satuan' => 'Bumil',
            'target_1' => 200,
            'target_2' => 200,
            'target_persen' => 1.00, // 100% as a float
            'target_des' => 'jumlah bumil estimasi',
            'pencapaian' => 45,
            'jenis_cakupan' => 'UKM Esensial',
            'jenis_indikator' => 'KIA dan KB',
            'jenis_subindikator' => 'Kesehatan Ibu dan KB',
            'total_cakupan' => null,
            'total_indikator' => 0.67, // 67% as a float
            'total_subindikator' => 0.7193,
            'cakupan' => 'UKM ESENSIAL',
            'nilai' => 45.00,
            'tahun' => 2024,
            'bulan' => 6,
            'tanggal' => 13,
            'akun_puskesmas' => '3',
            'komentar' => 'ya',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $generatedData = [];

        for ($i = 0; $i < 10; $i++) {
            $generatedData[] = array_merge($dataTemplate, [
                'upaya_kesehatan' => 'a' . ($i + 1),
                'kegiatan' => 'Cakupan K' . ($i + 1),
                'target_1' => 200 + ($i * 10),
                'target_2' => 200 + ($i * 10),
                'target_persen' => 1.00 + ($i * 0.01),
                'pencapaian' => 45 + ($i * 5),
                'total_indikator' => 0.67 + ($i * 0.03),
                'total_subindikator' => 0.7193 + ($i * 0.02),
                'nilai' => 45.00 + ($i * 2),
            ]);
        }

        DB::table('tbl_sinikimas_pkp')->insert($generatedData);

        // Data tambahan yang dimasukkan secara terpisah
        $additionalData = [
            [
                'upaya_kesehatan' => 'b',
                'kegiatan' => 'Cakupan K1',
                'satuan' => 'Bumil',
                'target_1' => 200,
                'target_2' => 200,
                'target_persen' => 1.00, // 100% as a float
                'target_des' => 'jumlah bumil estimasi',
                'pencapaian' => 45,
                'jenis_cakupan' => 'UKM Esensial',
                'jenis_indikator' => 'KIA dan KB',
                'jenis_subindikator' => 'Kesehatan Ibu dan KB',
                'total_cakupan' => null,
                'total_indikator' => 0.67, // 67% as a float
                'total_subindikator' => 0.7193,
                'cakupan' => 'UKM ESENSIAL',
                'nilai' => 45.00,
                'tahun' => 2023,
                'bulan' => 6,
                'tanggal' => 13,
                'akun_puskesmas' => '3',
                'komentar' => 'ya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'upaya_kesehatan' => 'c',
                'kegiatan' => 'Cakupan K1',
                'satuan' => 'Bumil',
                'target_1' => 200,
                'target_2' => 200,
                'target_persen' => 1.00, // 100% as a float
                'target_des' => 'jumlah bumil estimasi',
                'pencapaian' => 45,
                'jenis_cakupan' => 'UKM Esensial',
                'jenis_indikator' => 'KIA dan KB',
                'jenis_subindikator' => 'Kesehatan Ibu dan KB',
                'total_cakupan' => null,
                'total_indikator' => 0.67, // 67% as a float
                'total_subindikator' => 0.7193,
                'cakupan' => 'UKM ESENSIAL',
                'nilai' => 45.00,
                'tahun' => 2023,
                'bulan' => 6,
                'tanggal' => 13,
                'akun_puskesmas' => '3',
                'komentar' => 'ya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('tbl_sinikimas_pkp')->insert($additionalData);
    }
}
