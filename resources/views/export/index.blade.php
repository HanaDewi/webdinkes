@extends('kerangka.master')
@section('content')
    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Laporan Pencapaian</h4>
                    </div>
                    <form method="GET" action="{{ route('export.export') }}">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-2 col-form-label">Pilih Tahun</label>
                                <select name="tahun" id="" class="form-select" required>
                                    @foreach ($tahun as $thn)
                                        <option value="{{ $thn['tahun'] }}">{{ $thn['tahun'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="keg" class="col-sm-2 col-form-label">Pilih Capaian</label>
                                <select name="keg" id="" class="form-select" required>
                                    @foreach ($keg as $value)
                                        <option value="{{ $value['keg'] }}">{{ $value['keg'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="apbd" class="col-sm-2 col-form-label">Pilih Tahapan Apbd</label>
                                <select name="apbd" id="" class="form-select" required>
                                    @foreach ($apbd as $item)
                                        <option value="{{ $item['apbd'] }}">{{ $item['apbd'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="bulan" class="col-sm-2 col-form-label">Pilih Bulan</label>
                                <select name="bulan" id="" class="form-select">
                                    <option value="all">All</option>
                                    <option value="januari">Januari</option>
                                    <option value="februari">Februari</option>
                                    <option value="maret">Maret</option>
                                    <option value="april">April</option>
                                    <option value="mei">Mei</option>
                                    <option value="juni">Juni</option>
                                    <option value="juli">Juli</option>
                                    <option value="agustus">Agustus</option>
                                    <option value="september">September</option>
                                    <option value="oktober">Oktober</option>
                                    <option value="november">November</option>
                                    <option value="desember">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" name="export" value="pdf" type="submit">Export PDF</button>
                            <button class="btn btn-success" name="export" value="excel" type="submit">Export Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
@endsection
