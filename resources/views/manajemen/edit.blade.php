@extends('kerangka.master')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Edit Data</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="{{ route('manajemen.update', $manajemen->id) }}">
                        @csrf
                        @method('PUT') <!-- Untuk method PUT pada form Laravel -->

                        <div class="form-body">
                            <div class="row">
                                @if (auth()->user()->role == 'admin puskesmas')
                                    <div class="col-md-4">
                                        <label>Indikator</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="jenis_indikator" name="indikator" class="form-control">
                                            <option value="" selected disabled>Indikator</option>
                                            @foreach ($indikators as $value)
                                                <option value="{{ $value }}"
                                                    {{ old('indikator', $manajemen->indikator) == $value ? 'selected' : '' }}>
                                                    {{ $value }}
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
                                            <option value="" selected disabled>Sub Indikator</option>
                                            @foreach ($sub_indikators as $value)
                                                <option value="{{ $value }}"
                                                    {{ old('sub_indikator', $manajemen->sub_indikator) == $value ? 'selected' : '' }}>
                                                    {{ $value }}
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
                                            value="{{ old('jenis_variabel', $manajemen->jenis_variabel) }}">
                                        @error('jenis_variabel')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <label>Indikator</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="indikator" name="indikator"
                                            class="form-control bg-light @error('indikator') is-invalid @enderror"
                                            value="{{ old('indikator', $manajemen->indikator) }}" readonly>
                                        @error('indikator')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Sub Indikator</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="sub_indikator" name="sub_indikator"
                                            class="form-control @error('sub_indikator') is-invalid @enderror bg-light"
                                            value="{{ old('sub_indikator', $manajemen->sub_indikator) }}" readonly>
                                        @error('sub_indikator')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jenis Variabel</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="jenis_variabel" name="jenis_variabel"
                                            class="form-control bg-light @error('jenis_variabel') is-invalid @enderror"
                                            value="{{ old('jenis_variabel', $manajemen->jenis_variabel) }}" readonly>
                                        @error('jenis_variabel')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <label>Nilai 0</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="nilai_0" name="nilai_0"
                                        class="form-control @error('nilai_0') is-invalid @enderror"
                                        value="{{ old('nilai_0', $manajemen->nilai_0) }}">
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
                                        value="{{ old('nilai_4', $manajemen->nilai_4) }}">
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
                                        value="{{ old('nilai_7', $manajemen->nilai_7) }}">
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
                                        value="{{ old('nilai_10', $manajemen->nilai_10) }}">
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
                                        value="{{ old('nilai_hasil', $manajemen->nilai_hasil) }}">
                                    @error('nilai_hasil')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-4">
                                    <label>Akun Puskesmas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="akun_puskesmas" name="akun_puskesmas" class="form-control">
                                        <option value="" disabled selected>Akun Puskesmas</option>
                                        @foreach ($akun_puskesmas as $value)
                                            <option value="{{ $value }}"
                                                {{ old('akun_puskesmas', $manajemen->akun_puskesmas) == $value ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('akun_puskesmas')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                @if (auth()->user()->role == 'admin puskesmas')
                                    <div class="col-md-4">
                                        <label>Tahun</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="tahun" name="tahun"
                                            class="form-control @error('tahun') is-invalid @enderror"
                                            value="{{ old('tahun', $manajemen->tahun) }}">
                                        @error('tahun')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Bulan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="bulan" name="bulan" class="form-control">
                                            <option value="" disabled
                                                {{ old('bulan', $manajemen->bulan) === null ? 'selected' : '' }}>Pilih
                                                Bulan
                                            </option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('bulan', $manajemen->bulan) == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('bulan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <label>Tahun</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="tahun" name="tahun"
                                            class="form-control bg-light @error('tahun') is-invalid @enderror"
                                            value="{{ old('tahun', $manajemen->tahun) }}" readonly>
                                        @error('tahun')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Bulan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="bulan" name="bulan"
                                            class="form-control bg-light @error('bulan') is-invalid @enderror readonly"
                                            value="{{ old('bulan', $manajemen->bulan) }}" readonly>
                                        @error('bulan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 mb-1">Back</a>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
