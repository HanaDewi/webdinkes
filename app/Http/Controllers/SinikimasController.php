<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sinikimas;

class SinikimasController extends Controller
{
    public function sinikimas()
    {
        $sinikimas = Sinikimas::all();
        $tahun = Sinikimas::selectRaw('tahun')->distinct()->get();
        $jenis_cakupan = Sinikimas::selectRaw('jenis_cakupan')->distinct()->get();
        $jenis_indikator = Sinikimas::select('jenis_indikator')->distinct()->get();
        $jenis_subindikator = Sinikimas::select('jenis_subindikator')->distinct()->get();

        return view('sinikimas.sinikimas', compact('sinikimas', 'tahun', 'jenis_cakupan', 'jenis_indikator', 'jenis_subindikator'));
    }

    public function create()
    {
        return view('sinikimas.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no' => 'nullable|string',
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
}
