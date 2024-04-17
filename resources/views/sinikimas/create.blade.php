@extends('kerangka.master')
@section('content')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Create </h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" method="POST" action="{{ route('sinikimas.store') }}">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>No</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="no" name="no"
                                    class="form-control @error('no') is-invalid @enderror"
                                    value="{{ old('no') }}" placeholder="No">
                                @error('no')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Upaya Kesehatan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="upaya_kesehatan" name="upaya_kesehatan"
                                    class="form-control @error('upaya_kesehatan') is-invalid @enderror"
                                    value="{{ old('upaya_kesehatan') }}" placeholder="Upaya Kesehatan">
                                @error('upaya_kesehatan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Kegiatan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="kegiatan" name="kegiatan"
                                    class="form-control @error('kegiatan') is-invalid @enderror"
                                    value="{{ old('kegiatan') }}" placeholder="Kegiatan">
                                @error('kegiatan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Satuan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="satuan" name="satuan" class="form-control @error('satuan') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Satuan</option>
                                    <option value="Bumil" {{ old('satuan') == 'bumil' ? 'selected' : '' }}>Bumil</option>
                                    <option value="Bulin" {{ old('satuan') == 'bulin' ? 'selected' : '' }}>Bulin</option>
                                    <option value="Kasus" {{ old('satuan') == 'kasus' ? 'selected' : '' }}>Kasus</option>
                                    <option value="Akseptor" {{ old('satuan') == 'akseptor' ? 'selected' : '' }}>Akseptor</option>
                                    <option value="Catin" {{ old('satuan') == 'catin' ? 'selected' : '' }}>Catin</option>
                                    <option value="Bumil+Ab" {{ old('satuan') == 'bumil+ab' ? 'selected' : '' }}>Bumil+Ab</option>
                                </select>
                                @error('satuan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Realisasi --}}
                            <div class="col-md-4">
                                 <label>Target Sasaran</label>
                             </div>                                     
                              {{-- Tabel Realisasi --}}
                             <div class="col-md-8 offset-md-4">
                                 <table class="">
                                     <thead>
                                         <tr>
                                             <th></th>
                                             <th></th>
                                             <th></th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td><input type="text" id="realisasi_januari" name="realisasi_januari"
                                                     class="form-control @error('realisasi_januari') is-invalid @enderror"
                                                     value="{{ old('realisasi_januari') }}" placeholder="" style="width:100%;">
                                             </td>
                                             <td><input type="text" id="realisasi_februari" name="realisasi_februari"
                                                     class="form-control @error('realisasi_februari') is-invalid @enderror"
                                                     value="{{ old('realisasi_februari') }}" placeholder="" style="width:100%;">
                                             </td>
                                             <td><input type="text" id="realisasi_maret" name="realisasi_maret"
                                                     class="form-control @error('realisasi_maret') is-invalid @enderror"
                                                     value="{{ old('realisasi_maret') }}" placeholder="" style="width:100%;">
                                             </td>
                                         </tr>
                                         <tr>
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="realisasi_juli" name="realisasi_juli"
                                                class="form-control @error('realisasi_juli') is invalid @enderror"
                                                value="{{ old('realisasi_juli') }}" placeholder="" style="width:100%;">
                                            </td>
                                        </tr>
                                     </tbody>
                                 </table>
                             </div>
                             <div class="col-md-4">
                                <label>Pencapaian</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="pencapaian" name="pencapaian"
                                    class="form-control @error('pencapaian') is-invalid @enderror"
                                    value="{{ old('pencapaian') }}" placeholder="Pencapaian">
                                @error('pencapaian')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Cakupan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="cakupan" name="cakupan"
                                    class="form-control @error('cakupan') is-invalid @enderror"
                                    value="{{ old('cakupan') }}" placeholder="Cakupan">
                                @error('cakupan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Nilai</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nilai" name="nilai"
                                    class="form-control @error('nilai') is-invalid @enderror"
                                    value="{{ old('nilai') }}" placeholder="Nilai">
                                @error('nilai')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Jenis Cakupan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="jenis_cakupan" name="jenis_cakupan"
                                    class="form-control @error('jenis_cakupan') is-invalid @enderror"
                                    value="{{ old('jenis_cakupan') }}" placeholder="Jenis Cakupan">
                                @error('jenis_cakupan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
