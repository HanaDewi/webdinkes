@extends('kerangka.master')
@section('content')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Update Pencapaian</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
            @foreach($pencapaian as $pen)
                <form class="form form-horizontal" method="POST" action="{{ route('pencapaian.update', $id) }}">
                @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kode</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="kode" name="kode"
                                    class="form-control @error('kode') is invalid @enderror"
                                    value="{{ old('kode') ?? $pen ->kode }}" placeholder="Kode">
                                @error('kode')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Program</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="program" name="program"
                                    class="form-control @error('program') is invalid @enderror" value="{{ old('program') ?? $pen ->program }}"
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
                                    value="{{ old('indikator_kinerja') ?? $pen ->indikator_kinerja }}" placeholder="Indikator Kinerja">
                                @error('indikator_kinerja')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Tipe</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="tipe" name="tipe" class="form-control @error('tipe') is-invalid @enderror">
                                    <option value="" disabled>-- Pilih Tipe --</option>
                                    <option value="(+)Semakin Baik - (UMUM)" {{ (old('tipe') ?? $pen->tipe) == '(+)Semakin Baik - (UMUM)' ? 'selected' : '' }}>(+)Semakin Baik - (UMUM)</option>
                                    <option value="(-)Semakin Baik - (KHUSUS)" {{ (old('tipe') ?? $pen->tipe) == '(-)Semakin Baik - (KHUSUS)' ? 'selected' : '' }}>(-)Semakin Baik - (KHUSUS)</option>
                                </select>
                                @error('tipe')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label>Target</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="target" name="target"
                                    class="form-control @error('target') is invalid @enderror" value="{{ old('target') ?? $pen ->target }}"target
                                    placeholder="Target">
                                @error('target')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <!-- Realisasi -->
                                    <div class="col-md-4">
                                        <label>Realisasi</label>
                                    </div>
                                  
                                    <!-- Tabel Realisasi -->
                                    <div class="col-md-8 offset-md-4">
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
                                                            class="form-control @error('realisasi_januari') is-invalid @enderror"
                                                            value="{{ old('realisasi_januari') ?? $pen->realisasi_januari }}" placeholder="Januari" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_februari" name="realisasi_februari"
                                                            class="form-control @error('realisasi_februari') is-invalid @enderror"
                                                            value="{{ old('realisasi_februari') ?? $pen->realisasi_februari }}" placeholder="Februari" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_maret" name="realisasi_maret"
                                                        class="form-control @error('realisasi_maret') is-invalid @enderror"
                                                        value="{{ old('realisasi_maret') ?? $pen->realisasi_maret }}" placeholder="Maret" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_april" name="realisasi_april"
                                                        class="form-control @error('realisasi_april') is-invalid @enderror"
                                                        value="{{ old('realisasi_april') ?? $pen->realisasi_april }}" placeholder="April" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_mei" name="realisasi_mei"
                                                        class="form-control @error('realisasi_mei') is-invalid @enderror"
                                                        value="{{ old('realisasi_mei') ?? $pen->realisasi_mei }}" placeholder="Mei" style="width:100%;">
                                                    </td>
                                                    <td><input type="text" id="realisasi_juni" name="realisasi_juni"
                                                        class="form-control @error('realisasi_juni') is-invalid @enderror"
                                                        value="{{ old('realisasi_juni') ?? $pen->realisasi_juni }}" placeholder="Juni" style="width:100%;">
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
                                                    <td><input type="text" id="juli" name="juli"
                                                        class="form-control @error('juli') is-invalid @enderror"
                                                        value="{{ old('juli') ?? $pen->realisasi_juli }}" placeholder="Juli" style="width:100%;">
                                                </td>
                                                <td><input type="text" id="agustus" name="agustus"
                                                        class="form-control @error('agustus') is-invalid @enderror"
                                                        value="{{ old('agustus') ?? $pen->realisasi_agustus }}" placeholder="Agustus" style="width:100%;">
                                                </td>
                                                <td><input type="text" id="september" name="september"
                                                        class="form-control @error('september') is-invalid @enderror"
                                                        value="{{ old('september') ?? $pen->realisasi_september }}" placeholder="September" style="width:100%;">
                                                </td>
                                                <td><input type="text" id="oktober" name="oktober"
                                                        class="form-control @error('oktober') is-invalid @enderror"
                                                        value="{{ old('oktober') ?? $pen->realisasi_oktober }}" placeholder="Oktober" style="width:100%;">
                                                </td>
                                                <td><input type="text" id="november" name="november"
                                                        class="form-control @error('november') is-invalid @enderror"
                                                        value="{{ old('november') ?? $pen->realisasi_november }}" placeholder="November" style="width:100%;">
                                                </td>
                                                <td><input type="text" id="desember" name="desember"
                                                        class="form-control @error('desember') is-invalid @enderror"
                                                        value="{{ old('desember') ?? $pen->realisasi_desember }}" placeholder="Desember" style="width:100%;">
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Tahun</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="tahun" name="tahun" class="form-control @error('tahun') is-invalid @enderror">
                                            <option value="" disabled selected>-- Pilih Tahun --</option>
                                            <option value="2023" {{ (old('tahun') ?? $pen->tahun) == '2023' ? 'selected' : '' }}>2023</option>
                                            <option value="2024" {{ (old('tahun') ?? $pen->tahun) == '2024' ? 'selected' : '' }}>2024</option>
                                        </select>
                                        @error('tahun')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label>Kegiatan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="keg" name="keg" class="form-control @error('keg') is-invalid @enderror">
                                            <option value="" disabled selected>-- Pilih Kegiatan --</option>
                                            <option value="Kegiatan" {{ (old('keg') ?? $pen->keg) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                            <option value="Program" {{ (old('keg') ?? $pen->keg) == 'program' ? 'selected' : '' }}>Program</option>
                                            <option value="Sub Program" {{ (old('keg') ?? $pen->keg) == 'subprogram' ? 'selected' : '' }}>Sub Program</option>
                                        </select>
                                        @error('keg')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="col-md-4">
                                        <label>Tahapan APBD</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="apbd" name="apbd" class="form-control @error('apbd') is-invalid @enderror">
                                            <option value="" disabled selected>-- Tahapan APBD --</option>
                                            <option value="Murni" {{ (old('apbd') ?? $pen->apbd) == 'murni' ? 'selected' : '' }}>Murni</option>
                                            <option value="Pergeseran" {{ (old('apbd') ?? $pen->apbd) == 'pergeseran' ? 'selected' : '' }}>Pergeseran</option>
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
