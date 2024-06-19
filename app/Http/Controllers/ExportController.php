<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Models\Pencapaian;
use Illuminate\Http\Request;
use App\Exports\PencapaianExport;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = Pencapaian::selectRaw('tahun')->distinct()->get();
        $apbd = Pencapaian::select('apbd')->distinct()->get();
        $keg = Pencapaian::select('keg')->distinct()->get();
        return view("export.index",compact("tahun","apbd","keg"));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function export(Request $request)
    {
        $query = Pencapaian::where("tahun", $request->tahun)
                    ->where("keg", $request->keg)
                    ->where("apbd", $request->apbd);
    
        $pencapaians = $query->get();
    
        if ($request->bulan != 'all') {
            $bulan = $request->bulan;
            $pencapaians = $pencapaians->map(function ($item) use ($bulan) {
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
            $pencapaians = $pencapaians->map(function ($item) {
                return [
                    'kode' => $item->kode,
                    'program' => $item->program,
                    'indikator_kinerja' => $item->indikator_kinerja,
                    'tipe' => $item->tipe,
                    'target' => $item->target,
                    'realisasi_januari' => $item->realisasi_januari,
                    'realisasi_februari' => $item->realisasi_februari,
                    'realisasi_maret' => $item->realisasi_maret,
                    'realisasi_april' => $item->realisasi_april,
                    'realisasi_mei' => $item->realisasi_mei,
                    'realisasi_juni' => $item->realisasi_juni,
                    'realisasi_juli' => $item->realisasi_juli,
                    'realisasi_agustus' => $item->realisasi_agustus,
                    'realisasi_september' => $item->realisasi_september,
                    'realisasi_oktober' => $item->realisasi_oktober,
                    'realisasi_november' => $item->realisasi_november,
                    'realisasi_desember' => $item->realisasi_desember,
                    'realisasi_akhir' => $item->realisasi_akhir,
                    'komentar' => $item->komentar,
                ];
            });
        }
    
        if ($request->export == "pdf") {
            $pdf = FacadePdf::loadView('export.pencapaian_pdf', ["pencapaians" => $pencapaians, "bulan" => $request->bulan]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream();
        } else if($request->export == "excel"){
            return Excel::download(new PencapaianExport($request), 'pencapaian.xlsx');
        }
    }    
}
