<?php

namespace App\Exports;

use App\Models\tblSinikimasPkp;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SinikimasSheet implements FromView, ShouldAutoSize, WithHeadings
{
    protected $jenisCakupan;
    protected $data;
    protected $tahun;
    protected $akun_puskesmas;

    public function __construct($jenisCakupan, $data, $tahun, $akun_puskesmas)
    {
        $this->jenisCakupan = $jenisCakupan;
        $this->data = $data;
        $this->tahun = $tahun;
        $this->akun_puskesmas = $akun_puskesmas;
    }

    public function view(): View
    {
        // $results = [];

        // foreach ($this->data as $item) {
        //     $target_2 = $item->target_2;
        //     $target_persen = $item->target_persen;
        //     $pencapaian = $item->pencapaian;

        //     // Pastikan bahwa variabel adalah numerik dan konversi ke float
        //     if (is_numeric($target_2) && is_numeric($target_persen) && is_numeric($pencapaian)) {
        //         $target_2 = floatval($target_2);
        //         $target_persen = floatval($target_persen);
        //         $pencapaian = floatval($pencapaian);

        //         $target_persen_desimal = $target_persen / 100;
        //         $target_1 = $target_persen_desimal * $target_2;
        //         $sub_variabel = $pencapaian / $target_1 * 100;

        //         $L17 = $sub_variabel;
        //         $N17 = 100.0;

        //         $L17_decimal = $L17 / 100;
        //         $N17_decimal = $N17 / 100;

        //         $result = $L17_decimal > $N17_decimal ? $N17_decimal : $L17_decimal;
        //         $result_percent = $result * 100;

        //         // Menambahkan hasil perhitungan ke item atau array hasil
        //         $results[] = [
        //             'id' => $item->id,
        //             'result_percent' => $result_percent,
        //             'sub_variabel' => $sub_variabel,
        //             'target_1' => $target_1,
        //         ];
        //     } else {
        //         $results[] = [
        //             'id' => $item->id,
        //             'result_percent' => null,
        //             'sub_variabel' => null,
        //             'target_1' => null,
        //         ];
        //     }
        // }
        // Ambil data dari database untuk jenis_subindikator
        $data_jenis_subindikator = DB::table('tbl_sinikimas_pkp')
            ->select('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan', DB::raw('COUNT(*) as total_subindikator'), DB::raw('AVG(nilai) as nilai_rata_subindikator'))
            ->groupBy('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan')
            ->get();

        // Ambil data dari database untuk jenis_indikator
        $data_jenis_indikator = DB::table('tbl_sinikimas_pkp')
            ->select('jenis_indikator', 'jenis_cakupan', DB::raw('COUNT(*) as total_indikator'), DB::raw('AVG(nilai) as nilai_rata_indikator'))
            ->groupBy('jenis_indikator', 'jenis_cakupan')
            ->get();

        // Struktur hasil agar sesuai dengan format yang diinginkan
        $structured_data = [];

        foreach ($data_jenis_indikator as $indikator) {
            $jenis_cakupan = $indikator->jenis_cakupan;
            $jenis_indikator = $indikator->jenis_indikator;

            if (!isset($structured_data[$jenis_cakupan])) {
                $structured_data[$jenis_cakupan] = [];
            }

            $structured_data[$jenis_cakupan][$jenis_indikator] = [
                'total_indikator' => $indikator->total_indikator,
                'nilai_rata_indikator' => $indikator->nilai_rata_indikator,
                'sub_indikators' => [],
            ];
        }

        foreach ($data_jenis_subindikator as $subindikator) {
            $jenis_cakupan = $subindikator->jenis_cakupan;
            $jenis_indikator = $subindikator->jenis_indikator;

            if (isset($structured_data[$jenis_cakupan][$jenis_indikator])) {
                $structured_data[$jenis_cakupan][$jenis_indikator]['sub_indikators'][] = [
                    'jenis_subindikator' => $subindikator->jenis_subindikator,
                    'total_subindikator' => $subindikator->total_subindikator,
                    'nilai_rata_subindikator' => $subindikator->nilai_rata_subindikator,
                ];
            }
        }

        return view('export.sinikimasExportPkp', [
            'sinikimas' => $this->data,
            // 'results' => $results,
            'structured_data' => $structured_data,
            'jenisCakupan' => $this->jenisCakupan,
            'tahun' => $this->tahun,
            'akun_puskesmas' => $this->akun_puskesmas,
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Result Percent',
            'Sub Variabel',
            'Target 1',
            'Kegiatan',
            'Satuan',
            'Target 1',
            'Target 2',
            'Target Persen',
            'Target Des',
            'Pencapaian',
            'Cakupan Variabel',
            'Nilai',
        ];
    }
}
