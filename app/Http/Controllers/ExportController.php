<?php

namespace App\Http\Controllers;

use App\Exports\PencapaianExport;
use App\Exports\SinikimasExport;
use App\Http\Controllers\Controller;
use App\Models\Bulan;
use App\Models\Pencapaian;
use App\Models\tblSinikimasPkp;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function auth_login_sinikimas($auth)
    {
        if ($auth->check()) {
            $user = $auth->user();
            $responseData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ];

            return $responseData;
        } else {
            return false;
        }
    }

    public function index()
    {
        $akun_puskesmas = DB::table('users')->where('role', 'puskesmas')->get();
        $tahun = Pencapaian::selectRaw('tahun')->distinct()->get();
        $apbd = Pencapaian::select('apbd')->distinct()->get();
        $keg = Pencapaian::select('keg')->distinct()->get();
        return view("export.index", compact("tahun", "apbd", "keg"));
    }

    public function indexexportSinikimasPkp()
    {
        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {
            if ($responseData['role'] == "admin puskesmas") {
                $roles = $responseData['role'];
                $akun_puskesmas = DB::table("tbl_sinikimas_pkp")->selectRaw('akun_puskesmas')->distinct()->get();
                $tahun = DB::table("tbl_sinikimas_pkp")->selectRaw('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->selectRaw('bulan')->distinct()->get();
                $jenis_cakupan = DB::table("tbl_sinikimas_pkp")->selectRaw('jenis_cakupan')->distinct()->get();
                $jenis_indikator = DB::table("tbl_sinikimas_pkp")->select('jenis_indikator')->distinct()->get();
                $jenis_subindikator = DB::table("tbl_sinikimas_pkp")->select('jenis_subindikator')->distinct()->get();
            } else {
                $roles = $responseData['role'];
                $akun_puskesmas = $responseData['name'];
                $akun_puskesmas = DB::table("tbl_sinikimas_pkp")->selectRaw('akun_puskesmas')->distinct()->get();
                $tahun = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('bulan')->distinct()->get();
                $jenis_cakupan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('jenis_cakupan')->distinct()->get();
                $jenis_indikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_indikator')->distinct()->get();
                $jenis_subindikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_subindikator')->distinct()->get();
            }
            return view("export.indexexportsinikimaspkp", compact("akun_puskesmas", "tahun", "bulan", "jenis_cakupan", "jenis_indikator", "jenis_subindikator", "akun_puskesmas", "roles"));
        } else {
            return redirect()->route('login')->with('failed', 'Unauthenticated');
        }
    }
    public function indexSinikimasPkp()
    {
        $akun_puskesmas = DB::table('users')->where('role', 'puskesmas')->get();
        // $data_akun = User::all();
        // $tahun = tblSinikimasPkp::selectRaw('tahun')->distinct()->get();
        // $bulan = Bulan::all();
        // $cangkupan = DB::table('tbl_cangkupans')->get();
        // $indikator = DB::table('tbl_indikators')->get();
        // $subindikator = DB::table('tbl_subindikators')->get();

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {
            // dd($responseData);
            if ($responseData['role'] == "admin puskesmas") {
                $pkps = DB::table("tbl_sinikimas_pkp")->get();
                $tahun = DB::table("tbl_sinikimas_pkp")->selectRaw('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->selectRaw('bulan')->distinct()->get();
                $cakupan = DB::table("tbl_sinikimas_pkp")->selectRaw('jenis_cakupan')->distinct()->get();
                $indikator = DB::table("tbl_sinikimas_pkp")->select('jenis_indikator')->distinct()->get();
                $subindikator = DB::table("tbl_sinikimas_pkp")->select('jenis_subindikator')->distinct()->get();
            } else {
                $pkps = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->get();
                $tahun = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('bulan')->distinct()->get();
                $cakupan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('jenis_cakupan')->distinct()->get();
                $indikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_indikator')->distinct()->get();
                $subindikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_subindikator')->distinct()->get();
            }
            return view("export.indexSinikimasPkp", compact("akun_puskesmas", "tahun", "bulan", "cakupan", "indikator", "subindikator"));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function export(Request $request)
    {
        $pencapaians = Pencapaian::where("tahun", $request->tahun)->where("keg", $request->keg)->where("apbd", $request->apbd)->get();
        if ($request->export == "pdf") {
            $pdf = FacadePdf::loadView('export.pencapaian_pdf', ["pencapaians" => $pencapaians]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream();
        } else if ($request->export == "excel") {
            return Excel::download(new PencapaianExport($request), 'pencapaian.xlsx');
        }
    }

    public function exportSinikimasPkp(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'tahun' => 'required|string',
            'bulan' => 'required|string',
            'jenis_cakupan' => 'required|string',
            'jenis_indikator' => 'required|string',
            'jenis_subindikator' => 'required|string',
        ], [
            'tahun.required' => 'Tahun is required.',
            'bulan.required' => 'Bulan is required.',
            'jenis_cakupan.required' => 'Jenis Cakupan is required.',
            'jenis_indikator.required' => 'Jenis Indikator is required.',
            'jenis_subindikator.required' => 'Jenis Subindikator is required.',
        ]);

        $akun_puskesmas = $request->akun_puskesmas ?? 'all';
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $jenisCakupan = $request->jenis_cakupan;
        $jenisIndikator = $request->jenis_indikator;
        $jenisSubindikator = $request->jenis_subindikator;

        $sinikimasQuery = tblSinikimasPkp::query();

        if ($akun_puskesmas !== 'all') {
            $sinikimasQuery->where('akun_puskesmas', $akun_puskesmas);
        }

        if ($tahun !== 'all') {
            $sinikimasQuery->where('tahun', $tahun);
        }

        if ($bulan !== 'all') {
            $sinikimasQuery->where('bulan', $bulan);
        }

        if ($jenisCakupan !== 'all') {
            $sinikimasQuery->where('jenis_cakupan', $jenisCakupan);
        }

        if ($jenisIndikator !== 'all') {
            $sinikimasQuery->where('jenis_indikator', $jenisIndikator);
        }

        if ($jenisSubindikator !== 'all') {
            $sinikimasQuery->where('jenis_subindikator', $jenisSubindikator);
        }

        $sinikimas = $sinikimasQuery->get();

        // $results = [];

        // foreach ($sinikimas as $item) {
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
        //         // $sub_variabel_persen = $sub_variabel * 100;

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
        //             'target_1' => null
        //         ];

        //         // $item->result_percent = null;
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

        // dd($results);

        if ($sinikimas->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan untuk kriteria yang dipilih.');
        }

        if ($request->export == "pdf") {
            $pdf = FacadePdf::loadView('pdf.sinikimasPdfPkp', [
                "sinikimas" => $sinikimas,
                // 'results' => $results,
                'structured_data' => $structured_data,
                'tahun' => $tahun,
                'akun_puskesmas' => $akun_puskesmas
            ]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream();
        } elseif ($request->export == "excel") {
            return Excel::download(new SinikimasExport($akun_puskesmas, $tahun, $bulan, $jenisCakupan, $jenisIndikator, $jenisSubindikator), 'Data_Laporan_Sinikimas_' . ($tahun ?? 'All') . '.xlsx');
        } else {
            return redirect()->back()->with('error', 'Format export tidak valid.');
        }
    }
    public function exportSinikimasPkp2(Request $request)
    {
        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {

            $tahun = $request->tahun;
            $bulan = $request->bulan;
            $jenisCakupan = $request->jenis_cakupan;
            $jenisIndikator = $request->jenis_indikator;
            $jenisSubindikator = $request->jenis_subindikator;

            if ($responseData['role'] == "admin puskesmas") {
                // dd($request->all());
                $akun_puskesmas = $request->akun_puskesmas;
                $filterParams = $request->except('export');
                $isEmptyRequest = empty(array_filter($filterParams));

                if ($isEmptyRequest) {
                    $sinikimasQuery = DB::table('tbl_sinikimas_pkp')->get();
                    // dd("a");
                } else {
                    $sinikimasQuery = DB::table('tbl_sinikimas_pkp')
                        ->where('akun_puskesmas', $request->akun_puskesmas)
                        ->where('tahun', $request->tahun)
                        ->where('bulan', $request->bulan)
                        ->where('jenis_cakupan', $request->jenis_cakupan)
                        ->where('jenis_indikator', $request->jenis_indikator)
                        ->where('jenis_subindikator', $request->jenis_subindikator)
                        ->get();
                    // dd("b");
                }
                
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

                if ($request->export == "pdf") {
                    $pdf = FacadePdf::loadView('pdf.sinikimasPdfPkp', ["sinikimas" => $sinikimasQuery, 'structured_data' => $structured_data, 'tahun' => $tahun, 'akun_puskesmas' => $akun_puskesmas]);
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream();
                } else if ($request->export == "excel") {
                    return Excel::download(new SinikimasExport($request->akun_puskesmas, $request->tahun, $request->bulan, $request->jenis_cakupan, $request->jenis_indikator, $request->jenis_subindikator), 'Data_Laporan_Sinikimas_PKP.xlsx');
                }

            } else {

                $akun_puskesmas = $responseData['name'];
                ;
                $akun_puskesmas = $request->akun_puskesmas;
                $filterParams = $request->except('export');
                $isEmptyRequest = empty(array_filter($filterParams));

                if ($isEmptyRequest) {
                    $sinikimasQuery = tblSinikimasPkp::query()
                        ->where('akun_puskesmas', $responseData['name'])->get();
                } else {
                    $sinikimasQuery = tblSinikimasPkp::query()
                        ->where('akun_puskesmas', $responseData['name'])
                        ->where('tahun', $request->tahun)
                        ->where('bulan', $request->bulan)
                        ->where('jenis_cakupan', $request->jenis_cakupan)
                        ->where('jenis_indikator', $request->jenis_indikator)
                        ->where('jenis_subindikator', $request->jenis_subindikator)
                        ->get();
                }
                // dd($sinikimasQuery);
                                // Ambil data dari database untuk jenis_subindikator
                $data_jenis_subindikator = DB::table('tbl_sinikimas_pkp')
                    ->where('akun_puskesmas', $responseData['name'])
                    ->select('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan', DB::raw('COUNT(*) as total_subindikator'), DB::raw('AVG(nilai) as nilai_rata_subindikator'))
                    ->groupBy('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan')
                    ->get();

                // Ambil data dari database untuk jenis_indikator
                $data_jenis_indikator = DB::table('tbl_sinikimas_pkp')
                    ->where('akun_puskesmas', $responseData['name'])
                    ->select('jenis_indikator', 'jenis_cakupan', DB::raw('COUNT(*) as total_indikator'), DB::raw('AVG(nilai) as nilai_rata_indikator'))
                    ->groupBy('jenis_indikator', 'jenis_cakupan')
                    ->get();


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
                if ($request->export == "pdf") {
                    // dd($sinikimasQuery);
                    $pdf = FacadePdf::loadView('pdf.sinikimasPdfPkp', ["sinikimas" => $sinikimasQuery,'structured_data' => $structured_data,'tahun' => $tahun, 'akun_puskesmas' => $akun_puskesmas]);
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream();
                } else if ($request->export == "excel") {
                    return Excel::download(new SinikimasExport($akun_puskesmas, $tahun, $bulan, $jenisCakupan, $jenisIndikator, $jenisSubindikator), 'Data_Laporan_Sinikimas_PKP.xlsx');
                }
            }
            
        } else {
            return redirect()->route('login')->with('error', 'Unauthenticated');
        }
    }
}
