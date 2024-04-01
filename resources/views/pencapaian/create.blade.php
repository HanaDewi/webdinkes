@extends('kerangka.master')
@section('content')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Create Pencapaian</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" method="POST" action="{{ route('pencapaian.store') }}">
                    @csrf
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
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- Realisasi -->
                                    <!-- <div class="col-md-4">
                                        <label>Realisasi</label>
                                    </div>                                     -->
                                    <!-- Tabel Realisasi -->
                                    <!-- <div class="col-md-8 offset-md-4">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Januari</th>
                                                    <th>Februari</th>
                                                    <th>Maret</th>
                                                    <th>April</th>
                                                    <th>Mei</th>
                                                    <th>Juni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" id="realisasi_januari" name="realisasi_januari"
                                                            class="form-control @error('realisasi_januari') is invalid @enderror"
                                                            value="{{ old('realisasi_januari') }}" placeholder="Januari" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_februari" name="realisasi_februari"
                                                            class="form-control @error('realisasi_februari') is invalid @enderror"
                                                            value="{{ old('realisasi_februari') }}" placeholder="Februari" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_maret" name="realisasi_maret"
                                                            class="form-control @error('realisasi_maret') is invalid @enderror"
                                                            value="{{ old('realisasi_maret') }}" placeholder="Maret" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_april" name="realisasi_april"
                                                            class="form-control @error('realisasi_april') is invalid @enderror"
                                                            value="{{ old('realisasi_april') }}" placeholder="April" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_mei" name="realisasi_mei"
                                                            class="form-control @error('realisasi_mei') is invalid @enderror"
                                                            value="{{ old('realisasi_mei') }}" placeholder="Mei" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_juni" name="realisasi_juni"
                                                            class="form-control @error('realisasi_juni') is invalid @enderror"
                                                            value="{{ old('realisasi_juni') }}" placeholder="Juni" style="width:100%;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                </tr>
                                                <tr>
                                                    <th>Juli</th>
                                                    <th>Agustus</th>
                                                    <th>September</th>
                                                    <th>Oktober</th>
                                                    <th>November</th>
                                                    <th>Desember</th>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" id="realisasi_juli" name="realisasi_juli"
                                                        class="form-control @error('realisasi_juli') is invalid @enderror"
                                                        value="{{ old('realisasi_juli') }}" placeholder="Juli" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_agustus" name="realisasi_agustus"
                                                        class="form-control @error('realisasi_agustus') is invalid @enderror"
                                                        value="{{ old('realisasi_agustus') }}" placeholder="Agustus" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_september" name="realisasi_september"
                                                        class="form-control @error('realisasi_september') is invalid @enderror"
                                                        value="{{ old('realisasi_september') }}" placeholder="September" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_oktober" name="realisasi_oktober"
                                                        class="form-control @error('realisasi_oktober') is invalid @enderror"
                                                        value="{{ old('realisasi_oktober') }}" placeholder="Oktober" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_november" name="realisasi_november"
                                                        class="form-control @error('realisasi_november') is invalid @enderror"
                                                        value="{{ old('realisasi_november') }}" placeholder="November" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_desember" name="realisasi_desember"
                                                        class="form-control @error('realisasi_desember') is invalid @enderror"
                                                        value="{{ old('realisasi_desember') }}" placeholder="Desember" style="width:100%;">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> -->
                                    <!-- Kolom Realisasi Akhir -->
                                    {{-- <div class="col-md-4">
                                        <label>Realisasi Akhir (%)</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" id="realisasi_akhir" name="realisasi_akhir" step="0.01" max="100"
                                            class="form-control @error('realisasi_akhir') is invalid @enderror"
                                            value="{{ old('realisasi_akhir') }}" placeholder="Realisasi Akhir">
                                        @error('realisasi_akhir')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <!-- Kolom Definisi Operasional -->
                                    <!-- <div class="col-md-4">
                                        <label>Definisi Operasional</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="definisi_operasional" name="definisi_operasional"
                                            class="form-control @error('definisi_operasional') is invalid @enderror"
                                             placeholder="Definisi Operasional">
                                        @error('definisi_operasional')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
