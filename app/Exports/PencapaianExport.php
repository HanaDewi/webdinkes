<?php

namespace App\Exports;

use App\Models\Pencapaian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PencapaianExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Pencapaian::query()
            ->select(
                'kode',
                'program',
                'indikator_kinerja',
                'tipe',
                'target',
                'realisasi_januari',
                'realisasi_februari',
                'realisasi_maret',
                'realisasi_april',
                'realisasi_mei',
                'realisasi_juni',
                'realisasi_juli',
                'realisasi_agustus',
                'realisasi_september',
                'realisasi_oktober',
                'realisasi_november',
                'realisasi_desember',
                'realisasi_akhir',
                'komentar'
            )
            ->where("tahun", $this->request->tahun)
            ->where("keg", $this->request->keg)
            ->where("apbd", $this->request->apbd);

        if ($this->request->bulan != 'all') {
            $bulan = $this->request->bulan;
            return $query->get()->map(function ($item) use ($bulan) {
                return [
                    'kode' => $item->kode,
                    'program' => $item->program,
                    'indikator_kinerja' => $item->indikator_kinerja,
                    'tipe' => $item->tipe,
                    'target' => $item->target,
                    'realisasi_bulan' => $item->{'realisasi_' . strtolower($bulan)},
                    'realisasi_akhir' => $item->realisasi_akhir,
                    'komentar' => $item->komentar,
                ];
            });
        } else {
            return $query->get();
        }
    }

    public function headings(): array
    {
        if ($this->request->bulan != 'all') {
            return [
                'Kode',
                'Program',
                'Indikator Kinerja',
                'Tipe',
                'Target',
                'Realisasi ' . ucfirst($this->request->bulan),
                'Realisasi Akhir',
                'Komentar',
            ];
        } else {
            return [
                'Kode',
                'Program',
                'Indikator Kinerja',
                'Tipe',
                'Target',
                'Realisasi Januari',
                'Realisasi Februari',
                'Realisasi Maret',
                'Realisasi April',
                'Realisasi Mei',
                'Realisasi Juni',
                'Realisasi Juli',
                'Realisasi Agustus',
                'Realisasi September',
                'Realisasi Oktober',
                'Realisasi November',
                'Realisasi Desember',
                'Realisasi Akhir',
                'Komentar',
            ];
        }
    }
}
