<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pencapaian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;



class PencapaianController extends Controller
{
    public function pencapaian(Request $request): Response
{
    if (Auth::id()) {
        $role = Auth()->user()->role;
        if ($role == 'sub bidang') {
            $bidangId = Auth::user()->name;
            $query = Pencapaian::where('bidang', $bidangId);
        } else if ($role == 'admin') {
            $query = Pencapaian::query();
        }
    }
    $pencapaians = $query->get();
    $tahun = $query->selectRaw('tahun')->distinct()->get();
    $keg = $query->select('keg')->distinct()->get();
    $apbd = $query->select('apbd')->distinct()->get();
    
    $bulan_inggris = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $data_pencapaian = [];
    foreach ($pencapaians as $pencapaian) {
        $realisasi_januari_desember = $pencapaian->toArray();
        $realisasi_bulanan = [];
        foreach (range(0, 11) as $bulan_index) {
            $nama_bulan = $bulan_indonesia[$bulan_index];
            $field = "realisasi_" . strtolower($nama_bulan);
            $realisasi_bulanan[$nama_bulan] = $realisasi_bulanan[$nama_bulan] ?? 0 + $realisasi_januari_desember[$field];
        }
        $total_realisasi = array_sum($realisasi_bulanan);
        $pencapaian->realisasi_akhir_2 = $total_realisasi;
    }

    // dd($pencapaians);
    return response()->view('pencapaian.pencapaian', compact('pencapaians','tahun','keg','apbd' ));
}

    public function exportPencapaian(){
        return view('pdf.export-pencapaian');
    }

    public function exportPencapaianfilter($tahun, $keg, $apbd){
        dd(["Tahun: ".$tahun, "Capaian: ".$keg, "Apbd: ".$apbd]);
    }

    public function create()
    {
        return view('pencapaian.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode' => 'required|string',
            'program' => 'required|string',
            'indikator_kinerja' => 'nullable|string',
            'target' => 'required|numeric|max:100',
            'tahun' => 'required|numeric',
            'keg' => 'required|string',
            'apbd' => 'required|string',
        ]);

        $validateData['realisasi_akhir'] = 0;

        $pencapaian = Pencapaian::create($validateData);
        if ($pencapaian) {
            return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Menambah Data');
        } else {
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Menambah Data');
        }
    }

    public function edit($id)
    {
        $pencapaian = Pencapaian::where('id','=',$id)->get();
        $total_akhir = array_sum([
            $pencapaian[0]['realisasi_januari'],
            $pencapaian[0]['realisasi_februari'],
            $pencapaian[0]['realisasi_maret'],
            $pencapaian[0]['realisasi_april'],
            $pencapaian[0]['realisasi_mei'],
            $pencapaian[0]['realisasi_juni'],
            $pencapaian[0]['realisasi_juli'],
            $pencapaian[0]['realisasi_agustus'],
            $pencapaian[0]['realisasi_september'],
            $pencapaian[0]['realisasi_oktober'],
            $pencapaian[0]['realisasi_november'],
            $pencapaian[0]['realisasi_desember'],
        ]);
        return view('pencapaian.edit', compact('pencapaian','id','total_akhir'));
    }


    public function update(Request $request, Pencapaian $pencapaian)
    {
        $realisasi_akhir = 0; // Inisialisasi variabel realisasi_akhir

        if (auth()->user()->role == 'admin') {
            $validateData = $request->validate([
                'kode' => 'required|string',
                'tipe' => 'required|string',
                'program' => 'required|string',
                'indikator_kinerja' => 'nullable|string',
                'target' => 'required|numeric|max:100',
                'catatan' => 'nullable|string|max:1000',
                'tahun' => 'required|numeric',
                'keg' => 'required|string',
                'apbd' => 'required|string',
                'realisasi_akhir'=>'nullable',
                'realisasi_januari' => 'nullable|numeric',
                'realisasi_februari' => 'nullable|numeric',
                'realisasi_maret' => 'nullable|numeric',
                'realisasi_april' => 'nullable|numeric',
                'realisasi_mei' => 'nullable|numeric',
                'realisasi_juni' => 'nullable|numeric',
                'realisasi_juli' => 'nullable|numeric',
                'realisasi_agustus' => 'nullable|numeric',
                'realisasi_september' => 'nullable|numeric',
                'realisasi_oktober' => 'nullable|numeric',
                'realisasi_november' => 'nullable|numeric',
                'realisasi_desember' => 'nullable|numeric',
            ]);
        } else {
            $validateData = $request->validate([
                'tipe' => 'required|string',
                'realisasi_januari' => 'nullable|numeric',
                'realisasi_februari' => 'nullable|numeric',
                'realisasi_maret' => 'nullable|numeric',
                'realisasi_april' => 'nullable|numeric',
                'realisasi_mei' => 'nullable|numeric',
                'realisasi_juni' => 'nullable|numeric',
                'realisasi_juli' => 'nullable|numeric',
                'realisasi_agustus' => 'nullable|numeric',
                'realisasi_september' => 'nullable|numeric',
                'realisasi_oktober' => 'nullable|numeric',
                'realisasi_november' => 'nullable|numeric',
                'realisasi_desember' => 'nullable|numeric',
            ]);
            $realisasi_akhir = array_sum([
                $validateData['realisasi_januari'],
                $validateData['realisasi_februari'],
                $validateData['realisasi_maret'],
                $validateData['realisasi_april'],
                $validateData['realisasi_mei'],
                $validateData['realisasi_juni'],
                $validateData['realisasi_juli'],
                $validateData['realisasi_agustus'],
                $validateData['realisasi_september'],
                $validateData['realisasi_oktober'],
                $validateData['realisasi_november'],
                $validateData['realisasi_desember'],
            ]);
        }

        // Melakukan validasi jika realisasi_akhir melebihi 100
        if ($realisasi_akhir > 100) {
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Target melebihi 100');
        }

        $pencapaian->update($validateData); // Melakukan pembaruan pencapaian setelah semua validasi selesai dilakukan

        if ($pencapaian) {
            return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Update Data');
        } else {
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Update Data');
        }

    }

    public function delete($id)
    {
        $pencapaian = Pencapaian::find($id);
        // dd($pencapaian);
        $pencapaian->delete();
        if ($pencapaian) {
            return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Menghapus Data');
        } else {
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Menghapus Data');
        }
    }

    public function subprogram(Request $request)
{
    $query = Pencapaian::query();

    // Filter data berdasarkan peran pengguna yang sedang login
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'sub bidang') {
            $query->where('bidang', $user->name);
        }
    }

    // Terapkan filter tambahan berdasarkan permintaan pengguna
    if ($request->has('tahun')) {
        $query->where('tahun', $request->tahun);
    }
    if ($request->has('keg')) {
        $query->where('keg', $request->keg);
    }
    if ($request->has('apbd')) {
        $query->where('apbd', $request->apbd);
    }

    $pencapaians = $query->get();
    $keg = Pencapaian::select('keg')->distinct()->get();
    $tahun = Pencapaian::select('tahun')->distinct()->get();
    $apbd = Pencapaian::select('apbd')->distinct()->get();
    $req_tahun = $request->tahun;
    $req_keg = $request->keg;
    $req_apbd = $request->apbd;

    return view('pencapaian.subprogram', compact('pencapaians', 'keg', 'tahun', 'req_keg', 'req_tahun', 'req_apbd'));
}

    public function submit_user(Request $request, Pencapaian $pencapaian){
        $validateData = $request->validate([
            'tipe' => 'required|string',
            'realisasi_januari' => 'nullable|numeric',
            'realisasi_februari' => 'nullable|numeric',
            'realisasi_maret' => 'nullable|numeric',
            'realisasi_april' => 'nullable|numeric',
            'realisasi_mei' => 'nullable|numeric',
            'realisasi_juni' => 'nullable|numeric',
            'realisasi_juli' => 'nullable|numeric',
            'realisasi_agustus' => 'nullable|numeric',
            'realisasi_september' => 'nullable|numeric',
            'realisasi_oktober' => 'nullable|numeric',
            'realisasi_november' => 'nullable|numeric',
            'realisasi_desember' => 'nullable|numeric',
        ]);


        $realisasi_akhir = array_sum([
            $validateData['realisasi_januari'],
            $validateData['realisasi_februari'],
            $validateData['realisasi_maret'],
            $validateData['realisasi_april'],
            $validateData['realisasi_mei'],
            $validateData['realisasi_juni'],
            $validateData['realisasi_juli'],
            $validateData['realisasi_agustus'],
            $validateData['realisasi_september'],
            $validateData['realisasi_oktober'],
            $validateData['realisasi_november'],
            $validateData['realisasi_desember'],
        ]);

        if($realisasi_akhir>100){
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Realisasi melebihi 100');
        }else{
            $pencapaian->update($validateData);
        }
        if ($pencapaian) {
            return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Update Data');
        } else {
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Update Data');
        }
    }
    public function submit_admin(Request $request, Pencapaian $pencapaian){
        $validateData = $request->validate([
            'realisasi_akhir' => 'required',
            'komentar' => 'required|string',
        ]);
        if($request['realisasi_akhir']>100){
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Realisasi melebihi 100');
        }else{
            $pencapaian->update($validateData);
        }
        if ($pencapaian) {
            return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Update Data');
        } else {
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Update Data');
        }
    }

}

