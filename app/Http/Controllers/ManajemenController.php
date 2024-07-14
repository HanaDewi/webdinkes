<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manajemen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManajemenController extends Controller
{
    //

    public function index(){
        if(Auth::user()->role == 'admin puskesmas'){
            $data = Manajemen::all();
            $data = collect($data)->groupBy('akun_puskesmas');
        }else{
            $data = Manajemen::where('akun_puskesmas', Auth::user()->name)
            ->orWhereNull('akun_puskesmas')
            ->orderBy('indikator')
            ->get();

        }
        
       
        $indikators = Manajemen::distinct()->pluck('indikator');
        $akun_puskesmas = User::whereNotIn('id', [1, 2])->pluck('name');
        $tahun = Manajemen::distinct()->pluck('tahun');
        $bulan = Manajemen::distinct()->pluck('bulan');
        return view('manajemen.index', compact('data', 'indikators', 'akun_puskesmas', 'tahun', 'bulan'));
    }

    public function filter(Request $request){
        $akunPuskesmas = $request->input('akun_puskesmas');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $indikator = $request->input('jenis_indikator');

        if(Auth::user()->role == 'admin puskesmas'){
            $data = Manajemen::where(function ($query) {
                $query->where('akun_puskesmas', Auth::user()->name)
                      ->orWhereNull('akun_puskesmas');
            })->where('tahun', $tahun)->where('bulan', $bulan)->where('indikator',$indikator)->get();
            $data = collect($data)->groupBy('akun_puskesmas');
        }else{
            $data = Manajemen::where(function ($query) {
                $query->where('akun_puskesmas', Auth::user()->name)
                      ->orWhereNull('akun_puskesmas');
            })
            ->where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->where('indikator', $indikator)
            ->orderBy('indikator')
            ->get();

            
        }
       
        $indikators = Manajemen::distinct()->pluck('indikator');
        $akun_puskesmas = User::whereNotIn('id', [1, 2])->pluck('name');
        $tahun = Manajemen::distinct()->pluck('tahun');
        $bulan = Manajemen::distinct()->pluck('bulan');
        return view('manajemen.index', compact('data', 'indikators', 'akun_puskesmas', 'tahun', 'bulan'));
    }

    public function create(){
        $indikators = Manajemen::distinct()->pluck('indikator');
        $sub_indikators = Manajemen::distinct()->pluck('sub_indikator');
        // $akun_puskesmas = User::whereNotIn('id', [1, 2])->pluck('name');
        $akun_puskesmas = User::whereNotIn('id', [1, 2])->pluck('name');

        $tahun = Manajemen::distinct()->pluck('tahun');
        $bulan = Manajemen::distinct()->pluck('bulan');
        return view('manajemen.create',  compact('indikators', 'sub_indikators', 'akun_puskesmas', 'tahun', 'bulan'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'indikator' => 'required',
            'sub_indikator' => 'required',
            'jenis_variabel' => 'required',
            'nilai_0' => 'required',
            'nilai_4' => 'required',
            'nilai_7' => 'required',
            'nilai_10' => 'required',
            'nilai_hasil' => 'required|numeric',
            'tahun' => 'required',
            'bulan' => 'required',
            // 'akun_puskesmas' => 'required',
        ]);

        $manajemen = Manajemen::create($validatedData);


        // Redirect atau response setelah berhasil disimpan
        if($manajemen){
            return redirect()->route('manajemen.index')->with('success', 'Data berhasil disimpan.');
        }else{
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Gagal Menambah Data');

        }
    }

    public function update(Request $request, $id)
{
    // Validasi data input
    $validatedData = $request->validate([
        'indikator' => 'required',
        'sub_indikator' => 'required',
        'jenis_variabel' => 'required',
        'nilai_0' => 'required',
        'nilai_4' => 'required',
        'nilai_7' => 'required',
        'nilai_10' => 'required',
        'nilai_hasil' => 'required|numeric',
        'tahun' => 'required',
        'bulan' => 'required',
        // 'akun_puskesmas' => 'required',
    ]);

    // Cari data yang akan diupdate
    $manajemen = Manajemen::find($id);

    // Jika data tidak ditemukan, kembalikan response
    if (!$manajemen) {
        return redirect()->route('manajemen.index')->with('failed', 'Data tidak ditemukan.');
    }

    // Update data
    $manajemen->update($validatedData);

    // Redirect atau response setelah berhasil diupdate
    return redirect()->route('manajemen.index')->with('success', 'Data berhasil diupdate.');
}

        public function edit($id)
        {
            // Cari data yang akan diedit berdasarkan $id
            $manajemen = Manajemen::find($id);

            // Jika data tidak ditemukan, redirect dengan pesan kesalahan
            if (!$manajemen) {
                return redirect()->route('manajemen.index')->with('failed', 'Data tidak ditemukan.');
            }

            // Ambil data yang diperlukan untuk form edit
            $indikators = Manajemen::distinct()->pluck('indikator');
            $sub_indikators = Manajemen::distinct()->pluck('sub_indikator');
            $akun_puskesmas = User::whereNotIn('id', [1, 2])->pluck('name');
            $tahun = Manajemen::distinct()->pluck('tahun');
            $bulan = Manajemen::distinct()->pluck('bulan');

            // Kirim data ke view untuk ditampilkan dalam form edit
            return view('manajemen.edit', compact('manajemen', 'indikators', 'sub_indikators', 'akun_puskesmas', 'tahun', 'bulan'));
        }

        public function delete($id)
        {

            if (auth()->user()->role == "admin puskesmas") {
                $sinikimaspkp = Manajemen::where('id', $id)->delete();
                if ($sinikimaspkp) {
                    return redirect()->route('manajemen.index')->with('success', 'Berhasil Menghapus Data');
                } else {
                    return redirect()->route('manajemen.index')->with('failed', 'Data tidak ditemukan');
                }
            } else {
                return redirect()->back()->with('failed', 'Unauthenticated');
            }
        }


}
