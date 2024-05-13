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
        $pencapaians = Pencapaian::where("tahun",$request->tahun)->where("keg",$request->keg)->where("apbd",$request->apbd)->get();
        if ($request->export == "pdf") {
            $pdf = FacadePdf::loadView('export.pencapaian_pdf',["pencapaians" => $pencapaians]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream();
        } else if($request->export == "excel"){
            return Excel::download(new PencapaianExport($request), 'pencapaian.xlsx');
        }

    }
}
