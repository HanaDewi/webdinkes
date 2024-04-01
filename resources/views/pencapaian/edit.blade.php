@extends('kerangka.master')
@section('content')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Update Pencapaian</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" method="POST" action="{{ route('pencapaian.update', $pencapaian->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kode</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="kode" name="kode"
                                    class="form-control @error('kode') is invalid @enderror"
                                    value="{{ old('kode') }}" placeholder="Kode">
                                @error('kode')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Program</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="program" name="program"
                                    class="form-control @error('program') is invalid @enderror" value="{{ old('program') }}"
                                    placeholder="Program">
                                @error('program')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Indikator Kinerja</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="indikator_kinerja" name="indikator_kinerja"
                                    class="form-control @error('indikator_kinerja') is invalid @enderror"
                                    value="{{ old('indikator_kinerja') }}" placeholder="Indikator Kinerja">
                                @error('indikator_kinerja')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- <div class="col-md-4">
                                <label>Tipe</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="tipe" name="tipe" class="form-control @error('tipe') is invalid @enderror">
                                    <option value="" disabled selected>-- Pilih Tipe --</option>
                                    <option value="(+)Semakin Baik - (UMUM)" {{ old('tipe') == 'umum' ? 'selected' : '' }}>(+)Semakin Baik - (UMUM)</option>
                                    <option value="(-)Semakin Baik - (KHUSUS)" {{ old('tipe') == 'khusus' ? 'selected' : '' }}>(-)Semakin Baik - (KHUSUS)</option>
                                </select>
                                @error('tipe')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> -->
                            <div class="col-md-4">
                                <label>Target</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="target" name="target"
                                    class="form-control @error('target') is invalid @enderror" value="{{ old('target') }}"
                                    placeholder="Target">
                                @error('target')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Tahun</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="tahun" name="tahun"
                                    class="form-control @error('tahun') is invalid @enderror" value="{{ old('tahun') }}"
                                    placeholder="Tahun">
                                @error('tahun')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="col-md-4">
                                <label>Kegiatan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="keg" name="keg" class="form-control @error('keg') is invalid @enderror">
                                    <option value="" disabled selected>-- Pilih Kegiatan --</option>
                                    <option value="Program" {{ old('keg') == 'program' ? 'selected' : '' }}>Program</option>
                                    <option value="Sub Program" {{ old('keg') == 'subprogram' ? 'selected' : '' }}>Sub Program</option>
                                </select>
                                @error('keg')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                            <div class="col-md-4">
                                <label>Tahapan APBD</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="apbd" name="apbd" class="form-control @error('apbd') is invalid @enderror">
                                    <option value="" disabled selected>-- Tahapan APBD --</option>
                                    <option value="Murni" {{ old('apbd') == 'murni' ? 'selected' : '' }}>Murni</option>
                                    <option value="Pergeseran" {{ old('apbd') == 'pergeseran' ? 'selected' : '' }}>Pergeseran</option>
                                </select>
                                @error('apbd')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
