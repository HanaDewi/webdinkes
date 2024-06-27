<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sinikimas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SinikimasController extends Controller
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

    public function pkp()
    {

        // Tampilkan hasil
        // dd($structured_data);

        // Tampilkan hasil gabungan
        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {
            // dd($responseData);
            if ($responseData['role'] == "admin puskesmas") {
                $roles = $responseData['role'];

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

                $pkps = DB::table("tbl_sinikimas_pkp")->get();
                $akun_puskesmas = DB::table("tbl_sinikimas_pkp")->whereNotNull('akun_puskesmas')->selectRaw('akun_puskesmas')->distinct()->get();
                $tahun = DB::table("tbl_sinikimas_pkp")->selectRaw('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->selectRaw('bulan')->distinct()->get();
                $jenis_cakupan = DB::table("tbl_sinikimas_pkp")->selectRaw('jenis_cakupan')->distinct()->get();
                $jenis_indikator = DB::table("tbl_sinikimas_pkp")->select('jenis_indikator')->distinct()->get();
                $jenis_subindikator = DB::table("tbl_sinikimas_pkp")->select('jenis_subindikator')->distinct()->get();
            } else {
                $roles = $responseData['role'];

                // Ambil data dari database untuk jenis_subindikator
                $data_jenis_subindikator = DB::table('tbl_sinikimas_pkp')
                    ->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')
                    ->select('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan', DB::raw('COUNT(*) as total_subindikator'), DB::raw('AVG(nilai) as nilai_rata_subindikator'))
                    ->groupBy('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan')
                    ->get();

                // Ambil data dari database untuk jenis_indikator
                $data_jenis_indikator = DB::table('tbl_sinikimas_pkp')
                    ->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')
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

                $pkps = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->get();

                $akun_puskesmas = $responseData['name'];
                // DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('akun_puskesmas')->distinct()->get();
                $tahun = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('bulan')->distinct()->get();
                $jenis_cakupan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('jenis_cakupan')->distinct()->get();
                $jenis_indikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_indikator')->distinct()->get();
                $jenis_subindikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_subindikator')->distinct()->get();
            }
            // dd($pkps);
            return view("pkp.index", compact("pkps", "tahun", "bulan", "jenis_cakupan", "jenis_indikator", "jenis_subindikator", 'structured_data', "akun_puskesmas", "roles"));
        } else {

            return redirect()->route('login')->with('failed', 'Unauthenticated');
        }
    }
    public function create_pkp()
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {
            $jenis_cangkupans = DB::table('tbl_cangkupans')->get();
            $jenis_indikators = DB::table('tbl_indikators')->get();
            $jenis_subindikators = DB::table('tbl_subindikators')->get();
            return view('pkp.create', compact("jenis_cangkupans", "jenis_indikators", "jenis_subindikators"));
        } else {

            return redirect()->back()->with('failed', 'Unauthenticated');
        }
    }
    public function sinikimas()
    {
        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {

            $sinikimas = Sinikimas::all();
            $tahun = Sinikimas::selectRaw('tahun')->distinct()->get();
            $jenis_cakupan = Sinikimas::selectRaw('jenis_cakupan')->distinct()->get();
            $jenis_indikator = Sinikimas::select('jenis_indikator')->distinct()->get();
            $jenis_subindikator = Sinikimas::select('jenis_subindikator')->distinct()->get();

            return view('sinikimas.sinikimas', compact('sinikimas', 'tahun', 'jenis_cakupan', 'jenis_indikator', 'jenis_subindikator'));
        } else {
            return redirect()->route('login')->with('error', 'Unauthenticated');
        }
    }

    public function create()
    {

        return view('sinikimas.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([

            'upaya_kesehatan' => 'required|string',
            'kegiatan' => 'required|string',
            'satuan' => 'required|string',
            'target_1' => 'required|numeric',
            'target_2' => 'required|numeric',
            'target_persen' => 'required|numeric',
            'target_des' => 'required|string',
            'pencapaian' => 'required|numeric',
            'cakupan' => 'required|string',
            'nilai' => 'required|numeric',
            'jenis_cakupan' => 'nullable|string',
            'jenis_indikator' => 'nullable|string',
            'jenis_subindikator' => 'nullable|string',
            'tahun' => 'nullable|string',
            'akun_puskesmas' => 'nullable|string',
        ]);

        $sinikimas = Sinikimas::create($validateData);
        if ($sinikimas) {
            return redirect()->route('sinikimas.sinikimas')->with('success', 'Berhasil Menambah Data');
        } else {
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Gagal Menambah Data');
        }
    }
    public function store_pkp(Request $request)
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {
            $validateData = $request->validate([

                'upaya_kesehatan' => 'required|string',
                'kegiatan' => 'required|string',
                'satuan' => 'required|string',
                'target_1' => 'required|numeric',
                'target_2' => 'required|numeric',
                'target_persen' => 'required|numeric',
                'target_des' => 'required|string',
                'pencapaian' => 'required|numeric',
                'cakupan' => 'required|string',
                'nilai' => 'required|numeric',
                'sub_variabel' => 'required|numeric',
                'jenis_cakupan' => 'required|exists:tbl_cangkupans,name_cangkupan',
                'jenis_indikator' => 'required|exists:tbl_indikators,name_indikator',
                'jenis_subindikator' => 'required|exists:tbl_subindikators,name_subindikator',
                'tahun' => 'nullable|string',
                'bulan' => 'nullable|string',
                'akun_puskesmas' => 'nullable|string',
            ]);
            $akun_puskesmas = Auth::user()->name;

            $sinikimas = DB::table('tbl_sinikimas_pkp')->insert([
                'upaya_kesehatan' => $request->upaya_kesehatan,
                'kegiatan' => $request->kegiatan,
                'satuan' => $request->satuan,
                'target_1' => $request->target_1,
                'target_2' => $request->target_2,
                'target_persen' => $request->target_persen,
                'target_des' => $request->target_des,
                'pencapaian' => $request->pencapaian,
                'cakupan' => $request->cakupan,
                'jenis_cakupan' => $request->jenis_cakupan,
                'jenis_indikator' => $request->jenis_indikator,
                'jenis_subindikator' => $request->jenis_subindikator,
                // 'total_cangkupan' => $total_cangkupan,
                // 'total_indikator' => $total_indikator,
                // 'total_subindikator' => $total_subindikator,
                'sub_variabel' => $request->sub_variabel,
                'nilai' => $request->nilai,
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'akun_puskesmas' => null,
            ]);
            if ($sinikimas) {
                return redirect()->route('pkp.pkp')->with('success', 'Berhasil Menambah Data');
            } else {
                return redirect()->route('pkp.pkp')->with('failed', 'Gagal Menambah Data');
            }
        } else {
            return redirect()->back()->with('failed', 'Unauthenticated');
        }
    }

    public function edit($id)
    {
        $sinikimas = Sinikimas::find($id);
        if (!$sinikimas) {
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Data tidak ditemukan');
        }
        return view('sinikimas.edit', compact('sinikimas', 'id'));
    }
    public function edit_pkp($id)
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {
            if ($responseData['role'] == "admin puskesmas") {
                $jenis_cangkupans = DB::table('tbl_cangkupans')->get();
                $jenis_indikators = DB::table('tbl_indikators')->get();
                $jenis_subindikators = DB::table('tbl_subindikators')->get();

                $sinikimaspkp = DB::table('tbl_sinikimas_pkp')->where('id', $id)->first();
                // dd($sinikimaspkp);
                if (!$sinikimaspkp) {
                    return redirect()->route('pkp.pkp')->with('failed', 'Data tidak ditemukan');
                }
                $satuans = [
                    ['name_satuan' => 'Bumil'],
                    ['name_satuan' => 'Bulin'],
                    ['name_satuan' => 'Kasus'],
                    ['name_satuan' => 'Akseptor'],
                    ['name_satuan' => 'Catin'],
                    ['name_satuan' => 'Bumil+Ab'],
                ];
                $disable = false;
            } else {
                $jenis_cangkupans = DB::table('tbl_cangkupans')->get();
                $jenis_indikators = DB::table('tbl_indikators')->get();
                $jenis_subindikators = DB::table('tbl_subindikators')->get();

                $sinikimaspkp = DB::table('tbl_sinikimas_pkp')->where('id', $id)->first();
                // dd($sinikimaspkp);
                if (!$sinikimaspkp) {
                    return redirect()->route('pkp.pkp')->with('failed', 'Data tidak ditemukan');
                }
                $satuans = [
                    ['name_satuan' => 'Bumil'],
                    ['name_satuan' => 'Bulin'],
                    ['name_satuan' => 'Kasus'],
                    ['name_satuan' => 'Akseptor'],
                    ['name_satuan' => 'Catin'],
                    ['name_satuan' => 'Bumil+Ab'],
                ];
                $disable = true;
            }

            return view('pkp.edit', compact('sinikimaspkp', 'id', 'jenis_cangkupans', 'jenis_indikators', 'jenis_subindikators', 'satuans', 'disable'));
        } else {
            return redirect()->back()->with('failed', 'Unauthenticated');
        }
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'upaya_kesehatan' => 'required|string',
            'kegiatan' => 'required|string',
            'satuan' => 'required|string',
            'target_1' => 'required|numeric',
            'target_2' => 'required|numeric',
            'target_persen' => 'required|numeric',
            'target_des' => 'required|string',
            'pencapaian' => 'required|numeric',
            'cakupan' => 'required|string',
            'nilai' => 'required|numeric',
            'jenis_cakupan' => 'nullable|string',
            'jenis_indikator' => 'nullable|string',
            'jenis_subindikator' => 'nullable|string',
            'tahun' => 'nullable|string',
            'akun_puskesmas' => 'nullable|string',
        ];

        // Validate request data
        $validatedData = $request->validate($rules);

        // Find the data to be updated
        $sinikimas = Sinikimas::find($id);
        if (!$sinikimas) {
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Data tidak ditemukan');
        }

        // Update the data
        $sinikimas->update($validatedData);

        return redirect()->route('sinikimas.sinikimas')->with('success', 'Berhasil Update Data');
    }
    public function update_pkp(Request $request, $id)
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {

            $akun_puskesmas = Auth::user()->name;
            if ($responseData['role'] == "admin puskesmas") {
                $validateData = $request->validate([

                    'upaya_kesehatan' => 'required|string',
                    'kegiatan' => 'required|string',
                    'satuan' => 'required|string',
                    'target_1' => 'required|numeric',
                    'target_2' => 'required|numeric',
                    'target_persen' => 'required|numeric',
                    'target_des' => 'required|string',
                    'pencapaian' => 'required|numeric',
                    'cakupan' => 'required|string',
                    'nilai' => 'required|numeric',
                    'sub_variabel' => 'required|numeric',
                    'jenis_cakupan' => 'required|exists:tbl_cangkupans,name_cangkupan',
                    'jenis_indikator' => 'required|exists:tbl_indikators,name_indikator',
                    'jenis_subindikator' => 'required|exists:tbl_subindikators,name_subindikator',
                    'tahun' => 'nullable|string',
                    'bulan' => 'nullable|string',
                    'akun_puskesmas' => 'nullable|string',
                ]);
                $sinikimas = DB::table('tbl_sinikimas_pkp')->where('id', $id)->update([
                    'upaya_kesehatan' => $request->upaya_kesehatan,
                    'kegiatan' => $request->kegiatan,
                    'satuan' => $request->satuan,
                    'target_1' => $request->target_1,
                    'target_2' => $request->target_2,
                    'target_persen' => $request->target_persen,
                    'target_des' => $request->target_des,
                    'pencapaian' => $request->pencapaian,
                    'cakupan' => $request->cakupan,
                    'jenis_cakupan' => $request->jenis_cakupan,
                    'jenis_indikator' => $request->jenis_indikator,
                    'jenis_subindikator' => $request->jenis_subindikator,
                    // 'total_cangkupan' => $total_cangkupan,
                    // 'total_indikator' => $total_indikator,
                    // 'total_subindikator' => $total_subindikator,
                    'sub_variabel' => $request->sub_variabel,
                    'nilai' => $request->nilai,
                    'tahun' => $request->tahun,
                    'bulan' => $request->bulan,
                    'akun_puskesmas' => null,
                ]);
                if (!$sinikimas) {
                    return redirect()->route('pkp.pkp')->with('failed', 'Data tidak ditemukan');
                } else {

                    return redirect()->route('pkp.pkp')->with('success', 'Berhasil Update Data');
                }
            } else {
                $validateData = $request->validate([
                    'target_2' => 'required|numeric',
                    'target_persen' => 'required|numeric',
                    'pencapaian' => 'required|numeric',
                ]);
                $target_2 = $request->target_2;
                $target_persen = $request->target_persen;
                if (is_numeric($target_persen)) {
                    $target_persen .= '%';
                }
                $target_persen_desimal = str_replace('%', '', $target_persen) / 100;
                $target_1 = $target_2 * $target_persen_desimal;
                $pencapaian = $request->pencapaian;
                $sub_variabel = $pencapaian / $target_1;
                $sub_variabel_persen = $sub_variabel * 100;

                $L17 = $sub_variabel_persen;
                $N17 = 100.0;

                $L17_decimal = $L17 / 100;
                $N17_decimal = $N17 / 100;

                if ($L17_decimal > $N17_decimal) {
                    $result = $N17_decimal;
                } else {
                    $result = $L17_decimal;
                }

                $result_percent = $result * 100;

                $sinikimas = DB::table('tbl_sinikimas_pkp')->where('id', $id)->update([
                    'target_1' => $target_1,
                    'target_2' => $request->target_2,
                    'target_persen' => $request->target_persen,
                    'pencapaian' => $request->pencapaian,
                    'sub_variabel' => $sub_variabel_persen,
                    'nilai' => $result_percent,
                    'akun_puskesmas' => $akun_puskesmas,
                ]);
                if (!$sinikimas) {
                    return redirect()->route('pkp.pkp')->with('failed', 'Data tidak ditemukan');
                } else {
                    return redirect()->route('pkp.pkp')->with('success', 'Berhasil Update Data');
                }
            }
        } else {
            return redirect()->back()->with('failed', 'Unauthenticated');
        }
    }
    public function komentar(Request $request)
    {
        $update = DB::table('tbl_sinikimas_pkp')->where('id', $request->id)->update([
            'komentar' => $request->komentar
        ]);

        if (!$update) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data tidak ditemukan',
                'redirect_url' => route('pkp.pkp'),
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Update Data',
                'redirect_url' => route('pkp.pkp'),
            ], 200);
        }
    }

    public function delete($id)
    {
        $sinikimas = Sinikimas::find($id);

        if ($sinikimas) {
            $sinikimas->delete();
            return redirect()->route('sinikimas.sinikimas')->with('success', 'Berhasil Menghapus Data');
        } else {
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Data tidak ditemukan');
        }
    }
    public function delete_pkp($id)
    {
        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {
            $sinikimaspkp = DB::table('tbl_sinikimas_pkp')->where('id', $id)->delete();
            if ($sinikimaspkp) {
                return redirect()->route('pkp.pkp')->with('success', 'Berhasil Menghapus Data');
            } else {
                return redirect()->route('pkp.pkp')->with('failed', 'Data tidak ditemukan');
            }
        } else {
            return redirect()->back()->with('failed', 'Unauthenticated');
        }
    }
    public function tahun(Request $request)
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {

            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->select('tahun')
                ->distinct()
                ->get();
        } else {
            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = DB::table('tbl_sinikimas_pkp')
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                // ->where('akun_puskesmas', $akun_puskesmas)
                // ->orWhereNull('akun_puskesmas')
                ->select('tahun')
                ->distinct()
                ->get();
        }

        return response()->json($tahun);
    }
    public function bulan(Request $request)
    {
        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {

            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = $request->input('tahun');
            $bulan = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->where('tahun', $tahun)
                ->select('bulan')
                ->distinct()
                ->get();
        } else {
            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = $request->input('tahun');
            $bulan = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                // ->orWhereNull('akun_puskesmas')
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->where('tahun', $tahun)
                ->select('bulan')
                ->distinct()
                ->get();
        }

        return response()->json($bulan);
    }
    public function jenis_cakupan(Request $request)
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {

            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');

            $jenis_cakupan = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->select('jenis_cakupan')
                ->distinct()
                ->get();
        } else {

            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');

            $jenis_cakupan = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->select('jenis_cakupan')
                ->distinct()
                ->get();
        }
        return response()->json($jenis_cakupan);
    }
    public function jenis_indikator(Request $request)
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {

            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');
            $jenis_cakupan = $request->input('jenis_cakupan');

            $jenis_indikator = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->where('jenis_cakupan', $jenis_cakupan)
                ->select('jenis_indikator')
                ->distinct()
                ->get();
        } else {
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');
            $jenis_cakupan = $request->input('jenis_cakupan');

            $jenis_indikator = DB::table('tbl_sinikimas_pkp')
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->where('jenis_cakupan', $jenis_cakupan)
                ->select('jenis_indikator')
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->distinct()
                ->get();
        }
        return response()->json($jenis_indikator);
    }
    public function jenis_subindikator(Request $request)
    {
        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData && $responseData['role'] == "admin puskesmas") {

            $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');
            $jenis_cakupan = $request->input('jenis_cakupan');
            $jenis_indikator = $request->input('jenis_indikator');

            $jenis_subindikator = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->where('jenis_cakupan', $jenis_cakupan)
                ->where('jenis_indikator', $jenis_indikator)
                ->select('jenis_subindikator')
                ->distinct()
                ->get();
        } else {
            // $akun_puskesmas = $request->input('akun_puskesmas');
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');
            $jenis_cakupan = $request->input('jenis_cakupan');
            $jenis_indikator = $request->input('jenis_indikator');

            $jenis_subindikator = DB::table('tbl_sinikimas_pkp')
                // ->where('akun_puskesmas', $akun_puskesmas)
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->where('jenis_cakupan', $jenis_cakupan)
                ->where('jenis_indikator', $jenis_indikator)
                ->where(function ($query) use ($responseData) {
                    $query->where('akun_puskesmas', $responseData['name'])
                        ->orWhereNull('akun_puskesmas');
                })
                // ->orWhereNull('akun_puskesmas')
                ->select('jenis_subindikator')
                ->distinct()
                ->get();
        }

        return response()->json($jenis_subindikator);
    }

    public function filterpkp(Request $request)
    {

        $auth = auth();
        $responseData = $this->auth_login_sinikimas($auth);

        if ($responseData) {
            if ($responseData['role'] == "admin puskesmas") {
                $roles = $responseData['role'];

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

                if($request->all() == null){
              $pkps = DB::table('tbl_sinikimas_pkp')->get();
                }else{
              $pkps = DB::table('tbl_sinikimas_pkp')
                ->where('akun_puskesmas', $request->akun_puskesmas)
                ->where('tahun', $request->tahun)
                ->where('bulan', $request->bulan)
                ->where('jenis_cakupan', $request->jenis_cakupan)
                ->where('jenis_indikator', $request->jenis_indikator)
                ->where('jenis_subindikator', $request->jenis_subindikator)
                ->get();
                }

                $akun_puskesmas = DB::table("tbl_sinikimas_pkp")->whereNotNull('akun_puskesmas')->selectRaw('akun_puskesmas')->distinct()->get();

                $tahun = DB::table("tbl_sinikimas_pkp")->select('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->select('bulan')->distinct()->get();
                $jenis_cakupan = DB::table("tbl_sinikimas_pkp")->select('jenis_cakupan')->distinct()->get();
                $jenis_indikator = DB::table("tbl_sinikimas_pkp")->select('jenis_indikator')->distinct()->get();
                $jenis_subindikator = DB::table("tbl_sinikimas_pkp")->select('jenis_subindikator')->distinct()->get();
            } else {
                $roles = $responseData['role'];

                // Ambil data dari database untuk jenis_subindikator
                $data_jenis_subindikator = DB::table('tbl_sinikimas_pkp')
                    ->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')
                    ->select('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan', DB::raw('COUNT(*) as total_subindikator'), DB::raw('AVG(nilai) as nilai_rata_subindikator'))
                    ->groupBy('jenis_subindikator', 'jenis_indikator', 'jenis_cakupan')
                    ->get();

                // Ambil data dari database untuk jenis_indikator
                $data_jenis_indikator = DB::table('tbl_sinikimas_pkp')
                    ->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')
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
                $filterParams = $request->except('akun_puskesmas');
                $isEmptyRequest = empty(array_filter($filterParams));

                if ($isEmptyRequest) {
                    $pkps = DB::table('tbl_sinikimas_pkp')
                        // ->where('akun_puskesmas', $responseData['name'])
                        // ->orWhereNull('akun_puskesmas')
                        ->where(function ($query) use ($responseData) {
                            $query->where('akun_puskesmas', $responseData['name'])
                                ->orWhereNull('akun_puskesmas');
                        })
                        ->get();
                } else {
                    // dd($request->all());
                    $pkps = DB::table('tbl_sinikimas_pkp')
                        ->where('tahun', $request->tahun)
                        ->where('bulan', $request->bulan)
                        ->where('jenis_cakupan', $request->jenis_cakupan)
                        ->where('jenis_indikator', $request->jenis_indikator)
                        ->where('jenis_subindikator', $request->jenis_subindikator)
                        ->where(function ($query) use ($responseData) {
                            $query->where('akun_puskesmas', $responseData['name'])
                                ->orWhereNull('akun_puskesmas');
                        })
                        ->get();
                }
                // dd($request->all());
                $akun_puskesmas = $responseData['name'];

                $tahun = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('tahun')->distinct()->get();
                $bulan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('bulan')->distinct()->get();
                $jenis_cakupan = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->selectRaw('jenis_cakupan')->distinct()->get();
                $jenis_indikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_indikator')->distinct()->get();
                $jenis_subindikator = DB::table("tbl_sinikimas_pkp")->where('akun_puskesmas', $responseData['name'])->orWhereNull('akun_puskesmas')->select('jenis_subindikator')->distinct()->get();
            }
            // dd($request->all(),$pkps);

            return view("pkp.index", compact("pkps", "tahun", "bulan", "jenis_cakupan", "jenis_indikator", "jenis_subindikator", 'structured_data', "akun_puskesmas", "roles"));
        } else {
            return redirect()->route('login')->with('error', 'Unauthenticated');
        }
    }
    public function subsinikimas(Request $request)
    {
        $sinikimas = Sinikimas::where('tahun', '=', $request->tahun)->where('jenis_cakupan', '=', $request->jenis_cakupan)->where('jenis_indikator', '=', $request->jenis_indikator)->where('jenis_subindikator', '=', $request->jenis_subindikator)->get();
        $tahun = Sinikimas::select('tahun')->distinct()->get();
        $jenis_cakupan = Sinikimas::select('jenis_cakupan')->distinct()->get();
        $jenis_indikator = Sinikimas::select('jenis_indikator')->distinct()->get();
        $jenis_subindikator = Sinikimas::select('jenis_subindikator')->distinct()->get();

        return view('sinikimas.subsinikimas', compact('sinikimas', 'tahun', 'jenis_cakupan', 'jenis_indikator', 'jenis_subindikator'));
    }

    public function submit_user(Request $request, Sinikimas $sinikimas)
    {
        $validateData = $request->validate([
            'upaya_kesehatan' => 'required|string',
            'kegiatan' => 'required|string',
            'satuan' => 'required|string',
            'target_1' => 'required|numeric',
            'target_2' => 'required|numeric',
            'target_persen' => 'required|numeric',
            'target_des' => 'required|string',
            'pencapaian' => 'required|numeric',
            'cakupan' => 'required|string',
            'nilai' => 'required|numeric',
            'jenis_cakupan' => 'nullable|string',
            'jenis_indikator' => 'nullable|string',
            'jenis_subindikator' => 'nullable|string',
            'tahun' => 'nullable|string',
            'akun_puskesmas' => 'nullable|string',
        ]);

        if ($sinikimas) {
            return redirect()->route('sinikimas.sinikimas')->with('success', 'Berhasil Update Data');
        } else {
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Gagal Update Data');
        }
    }
    public function submit_admin(Request $request, Sinikimas $sinikimas)
    {
        $validateData = $request->validate([
            'komentar' => 'required|string',
        ]);

        if ($sinikimas) {
            return redirect()->route('sinikimas.sinikimas')->with('success', 'Berhasil Update Data');
        } else {
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Gagal Update Data');
        }
    }
}
