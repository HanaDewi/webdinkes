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

    // Apply additional filters
    if ($request->has('tahun')) {
        $query->where('tahun', $request->tahun);
    }
    if ($request->has('keg')) {
        $query->where('keg', $request->keg);
    }
    if ($request->has('apbd')) {
        $query->where('apbd', $request->apbd);
    }

    // Pagination and additional query string
    $pencapaians = $query->paginate(10)->appends($request->query());

    // Get unique filter data
    $tahun = Pencapaian::select('tahun')->distinct()->get();
    $keg = Pencapaian::select('keg')->distinct()->get();
    $apbd = Pencapaian::select('apbd')->distinct()->get();
    $bulan_inggris = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    // Calculate monthly realization
    foreach ($pencapaians as $pencapaian) {
        $realisasi_januari_desember = $pencapaian->toArray();
        $realisasi_bulanan = [];
        foreach (range(0, 11) as $bulan_index) {
            $nama_bulan = $bulan_indonesia[$bulan_index];
            $field = "realisasi_" . strtolower($nama_bulan);
            $realisasi_bulanan[$nama_bulan] = ($realisasi_januari_desember[$field] ?? 0);
        }
        $total_realisasi = array_sum($realisasi_bulanan);
        $pencapaian->realisasi_akhir = $total_realisasi;
    }

    return response()->view('pencapaian.pencapaian', compact('pencapaians', 'tahun', 'keg', 'apbd'));
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
        'komentar' => 'nullable|string|max:1000',
        'tahun' => 'required|numeric',
        'keg' => 'required|string',
        'apbd' => 'required|string',
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

    // Hitung realisasi akhir sebagai jumlah dari realisasi bulanan
    $realisasi_akhir = array_sum([
        $validateData['realisasi_januari'] ?? 0,
        $validateData['realisasi_februari'] ?? 0,
        $validateData['realisasi_maret'] ?? 0,
        $validateData['realisasi_april'] ?? 0,
        $validateData['realisasi_mei'] ?? 0,
        $validateData['realisasi_juni'] ?? 0,
        $validateData['realisasi_juli'] ?? 0,
        $validateData['realisasi_agustus'] ?? 0,
        $validateData['realisasi_september'] ?? 0,
        $validateData['realisasi_oktober'] ?? 0,
        $validateData['realisasi_november'] ?? 0,
        $validateData['realisasi_desember'] ?? 0,
    ]);

    // Masukkan nilai realisasi akhir ke dalam data yang akan disimpan
    $validateData['realisasi_akhir'] = $realisasi_akhir;

    $pencapaian = Pencapaian::create($validateData);
    if ($pencapaian) {
        return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Menambah Data');
    } else {
        return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Menambah Data');
    }
}

    public function edit($id)
{
    $pencapaian = Pencapaian::findOrFail($id); // Menggunakan findOrFail untuk mendapatkan data atau menampilkan 404 jika tidak ditemukan
    $realisasi_akhir = array_sum([
        $pencapaian->realisasi_januari,
        $pencapaian->realisasi_februari,
        $pencapaian->realisasi_maret,
        $pencapaian->realisasi_april,
        $pencapaian->realisasi_mei,
        $pencapaian->realisasi_juni,
        $pencapaian->realisasi_juli,
        $pencapaian->realisasi_agustus,
        $pencapaian->realisasi_september,
        $pencapaian->realisasi_oktober,
        $pencapaian->realisasi_november,
        $pencapaian->realisasi_desember,
    ]);
    // Mendapatkan tahun dari tabel Pencapaian atau dari sumber lain jika diperlukan
    $tahun = Pencapaian::select('tahun')->distinct()->orderBy('tahun', 'asc')->get();
    // Mendapatkan keg dari tabel Pencapaian atau dari sumber lain jika diperlukan
    $keg = Pencapaian::select('keg')->distinct()->orderBy('keg', 'asc')->get();
    // Mendapatkan apbd dari tabel Pencapaian atau dari sumber lain jika diperlukan
    $apbd = Pencapaian::select('apbd')->distinct()->orderBy('apbd', 'asc')->get();
    return view('pencapaian.edit', compact('pencapaian', 'id', 'realisasi_akhir', 'tahun', 'keg', 'apbd'));
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
            'komentar' => 'nullable|string|max:1000',
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
            $validateData['realisasi_januari'] ?? 0,
            $validateData['realisasi_februari'] ?? 0,
            $validateData['realisasi_maret'] ?? 0,
            $validateData['realisasi_april'] ?? 0,
            $validateData['realisasi_mei'] ?? 0,
            $validateData['realisasi_juni'] ?? 0,
            $validateData['realisasi_juli'] ?? 0,
            $validateData['realisasi_agustus'] ?? 0,
            $validateData['realisasi_september'] ?? 0,
            $validateData['realisasi_oktober'] ?? 0,
            $validateData['realisasi_november'] ?? 0,
            $validateData['realisasi_desember'] ?? 0,
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
    if (Auth::id()) {
        $role = Auth()->user()->role;
        if ($role == 'sub bidang') {
            $bidangId = Auth::user()->name;
            $query = Pencapaian::where('bidang', $bidangId);
        } else if ($role == 'admin') {
            $query = Pencapaian::query();
        }
    }

    // Apply additional filters
    if ($request->has('tahun')) {
        $query->where('tahun', $request->tahun);
    }
    if ($request->has('keg')) {
        $query->where('keg', $request->keg);
    }
    if ($request->has('apbd')) {
        $query->where('apbd', $request->apbd);
    }

    // Pagination and additional query string
    $pencapaians = $query->paginate(10)->appends($request->query());

    // Get unique filter data
    $tahun = Pencapaian::select('tahun')->distinct()->get();
    $keg = Pencapaian::select('keg')->distinct()->get();
    $apbd = Pencapaian::select('apbd')->distinct()->get();
    $bulan_inggris = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    // Calculate monthly realization
    foreach ($pencapaians as $pencapaian) {
        $realisasi_januari_desember = $pencapaian->toArray();
        $realisasi_bulanan = [];
        foreach (range(0, 11) as $bulan_index) {
            $nama_bulan = $bulan_indonesia[$bulan_index];
            $field = "realisasi_" . strtolower($nama_bulan);
            $realisasi_bulanan[$nama_bulan] = ($realisasi_januari_desember[$field] ?? 0);
        }
        $total_realisasi = array_sum($realisasi_bulanan);
        $pencapaian->realisasi_akhir = $total_realisasi;
    }

    return response()->view('pencapaian.pencapaian', compact('pencapaians', 'tahun', 'keg', 'apbd'));
}
    
    
public function submit_user(Request $request, Pencapaian $pencapaian)
{
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
        $validateData['realisasi_januari'] ?? 0,
        $validateData['realisasi_februari'] ?? 0,
        $validateData['realisasi_maret'] ?? 0,
        $validateData['realisasi_april'] ?? 0,
        $validateData['realisasi_mei'] ?? 0,
        $validateData['realisasi_juni'] ?? 0,
        $validateData['realisasi_juli'] ?? 0,
        $validateData['realisasi_agustus'] ?? 0,
        $validateData['realisasi_september'] ?? 0,
        $validateData['realisasi_oktober'] ?? 0,
        $validateData['realisasi_november'] ?? 0,
        $validateData['realisasi_desember'] ?? 0,
    ]);

    $validateData['realisasi_akhir'] = $realisasi_akhir;

    if ($realisasi_akhir > 100) {
        return redirect()->route('pencapaian.pencapaian')->with('failed', 'Realisasi melebihi 100');
    } else {
        $pencapaian->update($validateData);
    }

    if ($pencapaian) {
        return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Update Data');
    } else {
        return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Update Data');
    }
}


    public function submit_admin(Request $request, Pencapaian $pencapaian)
    {
        $validateData = $request->validate([
            'realisasi_akhir' => 'required|numeric|max:100',
            'komentar' => 'required|string',
        ]);

        $pencapaian->update($validateData);

        if ($pencapaian) {
            return redirect()->route('pencapaian.pencapaian')->with('success', 'Berhasil Update Data');
        } else {
            return redirect()->route('pencapaian.pencapaian')->with('failed', 'Gagal Update Data');
        }
    }

}
