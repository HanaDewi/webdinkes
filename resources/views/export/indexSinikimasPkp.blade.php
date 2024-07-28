{{-- @extends('kerangka.master')
@section('content')
    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Export Laporan Sinikimas</h4>
                    </div>
                    <form method="GET" action="{{ route('export.sinikimas') }}" id="exportForm">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="akun_puskesmas" class="col-form-label">Pilih Akun Puskesmas</label>
                                @if (auth()->user()->role == 'puskesmas')
                                    <input type="hidden" name="akun_puskesmas" value="{{ Auth::user()->name }}" readonly>
                                @endif
                                <select name="akun_puskesmas" id="akun_puskesmas"
                                    {{ auth()->user()->role == 'puskesmas' ? 'disabled' : '' }}
                                    class="form-select @error('akun_puskesmas') is-invalid @enderror" required>
                                    <option value="all">Pilih Akun</option>
                                    @foreach ($akun_puskesmas as $akun)
                                        <option value="{{ $akun->name }}"
                                            {{ old('akun_puskesmas', auth()->user()->role == 'puskesmas' ? auth()->user()->id : '') == $akun->id ? 'selected' : '' }}>
                                            {{ $akun->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('akun_puskesmas')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="tahun" class="col-form-label">Pilih Tahun</label>
                                <select name="tahun" id="tahun"
                                    class="form-select @error('tahun') is-invalid @enderror" required>
                                    <option value="all">Pilih Tahun</option>
                                    @foreach ($tahun as $thn)
                                        <option value="{{ $thn->tahun }}">{{ $thn->tahun }}</option>
                                    @endforeach
                                </select>
                                @error('tahun')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="bulan" class="col-form-label">Pilih Bulan</label>
                                <select name="bulan" id="bulan"
                                    class="form-select @error('bulan') is-invalid @enderror" required>
                                    <option value="all">Pilih Bulan</option>
                                    @foreach ($bulan as $bln)
                                        <option value="{{ $bln->bulan }}">{{ $bln->bulan }}</option>
                                    @endforeach
                                </select>
                                @error('bulan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="jenis_cakupan" class="col-form-label">Pilih Cakupan</label>
                                <select name="jenis_cakupan" id="jenis_cakupan"
                                    class="form-select @error('jenis_cakupan') is-invalid @enderror" required>
                                    <option value="all">Pilih Cakupan</option>
                                    @foreach ($cakupan as $value)
                                        <option value="{{ $value->jenis_cakupan }}">{{ $value->jenis_cakupan }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_cakupan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="jenis_indikator" class="col-form-label">Pilih Tahapan Indikator</label>
                                <select name="jenis_indikator" id="jenis_indikator"
                                    class="form-select @error('jenis_indikator') is-invalid @enderror" required>
                                    <option value="all">Pilih Tahapan Indikator</option>
                                    @foreach ($indikator as $item)
                                        <option value="{{ $item->jenis_indikator }}">{{ $item->jenis_indikator }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_indikator')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="jenis_subindikator" class="col-form-label">Pilih Tahapan Sub Indikator</label>
                                <select name="jenis_subindikator" id="jenis_subindikator"
                                    class="form-select @error('jenis_subindikator') is-invalid @enderror" required>
                                    <option value="all">Pilih Tahapan Sub Indikator</option>
                                    @foreach ($subindikator as $item)
                                        <option value="{{ $item->jenis_subindikator }}">{{ $item->jenis_subindikator }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_subindikator')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" name="export" value="pdf" type="submit">Export PDF</button>
                            <button class="btn btn-success" name="export" value="excel" type="submit">Export
                                Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection --}}
