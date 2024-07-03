<?php

namespace App\Exports;

use App\Models\tblSinikimasPkp;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SinikimasExport implements WithMultipleSheets
{
    use Exportable;

    protected $akun_puskesmas;
    protected $tahun;
    protected $bulan;
    protected $jenisCakupan;
    protected $jenisIndikator;
    protected $jenisSubindikator;

    public function __construct($akun_puskesmas = null, $tahun = null, $bulan = null, $jenisCakupan = null, $jenisIndikator = null, $jenisSubindikator = null)
    {
        $this->akun_puskesmas = $akun_puskesmas;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
        $this->jenisCakupan = $jenisCakupan;
        $this->jenisIndikator = $jenisIndikator;
        $this->jenisSubindikator = $jenisSubindikator;
    }

    public function sheets(): array
    {
        

        $sheets = [];
        $query = tblSinikimasPkp::query();

        if ($this->akun_puskesmas) {
            $query->where('akun_puskesmas', $this->akun_puskesmas);
        }

        if ($this->tahun) {
            $query->where('tahun', $this->tahun);
        }

        if ($this->bulan) {
            $query->where('bulan', $this->bulan);
        }

        if ($this->jenisCakupan) {
            $query->where('jenis_cakupan', $this->jenisCakupan);
        }

        if ($this->jenisIndikator) {
            $query->where('jenis_indikator', $this->jenisIndikator);
        }

        if ($this->jenisSubindikator) {
            $query->where('jenis_subindikator', $this->jenisSubindikator);
        }

        $sinikimas = $query->get();
$groupedData = $sinikimas->groupBy('jenis_cakupan');

        foreach ($groupedData as $jenisCakupan => $data) {
            $sheets[] = new SinikimasSheet($jenisCakupan, $data, $this->tahun, $this->akun_puskesmas);
        }

        return $sheets;

        
    }
}
