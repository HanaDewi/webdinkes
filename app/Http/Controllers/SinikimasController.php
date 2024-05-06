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

    public function edit($id)
    {
        $sinikimas = Sinikimas::find($id);
        if (!$sinikimas) {
            return redirect()->route('sinikimas.sinikimas')->with('failed', 'Data tidak ditemukan');
        }
        return view('sinikimas.edit', compact('sinikimas', 'id'));
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
    public function subsinikimas(Request $request)
    {
        $sinikimas = Sinikimas::where('tahun','=', $request->tahun)->where('jenis_cakupan','=',$request->jenis_cakupan)->where('jenis_indikator','=',$request->jenis_indikator)->where('jenis_subindikator','=',$request->jenis_subindikator)->get();
        $tahun = Sinikimas::select('tahun')->distinct()->get();
        $jenis_cakupan = Sinikimas::select('jenis_cakupan')->distinct()->get();
        $jenis_indikator = Sinikimas::select('jenis_indikator')->distinct()->get();
        $jenis_subindikator = Sinikimas::select('jenis_subindikator')->distinct()->get();

        return view('sinikimas.subsinikimas', compact('sinikimas','tahun','jenis_cakupan','jenis_indikator','jenis_subindikator'));
    }
    
    public function submit_user(Request $request, Sinikimas $sinikimas){
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
    public function submit_admin(Request $request, Sinikimas $sinikimas){
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

