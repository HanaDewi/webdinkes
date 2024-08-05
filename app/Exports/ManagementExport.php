<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ManagementExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;
    protected $indikators;
    protected $akun_puskesmas;
    protected $tahun;
    protected $bulan;

    public function __construct($data, $indikators, $akun_puskesmas, $tahun, $bulan)
    {
        $this->data = $data;
        $this->indikators = $indikators;
        $this->akun_puskesmas = $akun_puskesmas;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function view() : View
    {
        return view('pdf.managementpdf', [
            'data' => $this->data,
            'indikators' => $this->indikators,
            'akun_puskesmas' => $this->akun_puskesmas,
            'tahun' => $this->tahun,
            'bulan' => $this->bulan
        ]);
    }
}
