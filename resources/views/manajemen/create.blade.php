@extends('kerangka.master')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Create </h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="{{ route('manajemen.store') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Indikator</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="jenis_indikator" name="indikator" class="form-control">
                                        <option value="" selected>Indikator</option>
                                        @foreach ($indikators as $value)
                                            <option value="{{ $value }}"
                                                {{ old('indikator') == $value ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('indikator')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Sub Indikator</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="jenis_indikator" name="sub_indikator" class="form-control">
                                        <option value="" selected>Sub Indikator</option>
                                        @foreach ($sub_indikators as $value)
                                            <option value="{{ $value }}"
                                                {{ old('sub_indikator') == $value ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sub_indikator')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Jenis Variabel</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="jenis_variabel" name="jenis_variabel"
                                        class="form-control @error('jenis_variabel') is-invalid @enderror"
                                        value="{{ old('jenis_variabel') }}">
                                    @error('jenis_variabel')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Nilai 0</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="nilai_0" name="nilai_0"
                                        class="form-control @error('nilai_0') is-invalid @enderror"
                                        value="{{ old('nilai_0') }}">
                                    @error('nilai_0')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Nilai 4</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="nilai_4" name="nilai_4"
                                        class="form-control @error('nilai_4') is-invalid @enderror"
                                        value="{{ old('nilai_4') }}">
                                    @error('nilai_4')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Nilai 7</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="nilai_7" name="nilai_7"
                                        class="form-control @error('nilai_7') is-invalid @enderror"
                                        value="{{ old('nilai_7') }}">
                                    @error('nilai_7')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Nilai 10</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="nilai_10" name="nilai_10"
                                        class="form-control @error('nilai_10') is-invalid @enderror"
                                        value="{{ old('nilai_10') }}">
                                    @error('nilai_10')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Nilai Hasil</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="number" id="nilai_hasil" name="nilai_hasil"
                                        class="form-control @error('nilai_hasil') is-invalid @enderror"
                                        value="{{ old('nilai_hasil') }}">
                                    @error('nilai_hasil')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-4">
                                    <label>Akun Puskesmas</label>
                                </div> --}}
                                {{-- <div class="col-md-8 form-group">
                                    <select id="akun_puskesmas" name="akun_puskesmas" class="form-control">
                                        <option value="" disabled selected>Akun Puskesmas</option>
                                        @foreach ($akun_puskesmas as $value)
                                            <option value="{{ $value }}"
                                                {{ old('akun_puskesmas') == $value ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('akun_puskesmas')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="col-md-4">
                                    <label>Tahun</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="number" id="tahun" name="tahun"
                                        class="form-control @error('tahun') is-invalid @enderror"
                                        value="{{ old('tahun') }}">
                                    @error('tahun')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Bulan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="bulan" name="bulan" class="form-control">
                                        <option value="" disabled {{ old('bulan') === null ? 'selected' : '' }}>Pilih Bulan</option>
                                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $month)
                                            <option value="{{ $index + 1 }}" {{ old('bulan') == $index + 1 ? 'selected' : '' }}>
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bulan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 mb-1">Back</a>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
