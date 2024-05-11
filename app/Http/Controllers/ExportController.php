<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Pencapaian;
use Illuminate\Http\Request;
use App\Exports\PencapaianExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;



class ExportController extends Controller
{
    // Your other methods...

    /**
     * Store a newly created resource in storage.
     */
    public function export(Request $request)
    {
        $pencapaians = Pencapaian::where("tahun", $request->tahun)
            ->where("keg", $request->keg)
            ->where("apbd", $request->apbd)
            ->get();

        if ($request->export == "pdf") {
            $pdf = PDF::loadView('export.pencapaian_pdf', ["pencapaians" => $pencapaians]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream();
        } elseif ($request->export == "excel") {
            return Excel::download(new PencapaianExport($request), 'pencapaian.xlsx');
        }
    }
}
