@extends('kerangka.master')
@section('content')
    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Export Laporan Manajemen</h4>
                    </div>
                    <form method="GET" action="{{ route('export.management') }}">
                        <div class="card-body">
                            @if (auth()->user()->role == 'admin puskesmas')
                            <div class="form-group row">
                                <label for="akun_puskesmaspkp" class="col-form-label">Pilih Akun Puskesmas</label>
                                <select id="akun_puskesmaspkp" name="akun_puskesmas" class="form-select">
                                    <option value="" disabled selected>Akun Puskesmas</option>
                                    @foreach ($akun_puskesmas as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="tahunpkp" class="col-form-label">Pilih Tahun</label>
                                <select id="tahunpkp" name="tahun" class="form-select" disabled>
                                    <option value="" disabled selected>Tahun</option>
                                    @foreach ($tahun as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="bulanpkp" class="col-form-label">Pilih Bulan</label>
                                <select id="bulanpkp" name="bulan" class="form-select" disabled>
                                    <option value="" disabled selected>Bulan</option>
                                    @foreach ($bulan as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_indikatorpkp" class="col-form-label">Pilih Jenis Indikator</label>
                                <select id="jenis_indikatorpkp" name="jenis_indikator" class="form-select" disabled>
                                    <option value="" selected>Indikator</option>
                                    @foreach ($indikators as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" name="export" id="pdf" value="pdf" type="submit" disabled>Export PDF</button>
                            <button class="btn btn-success" name="export" id="excel" value="excel" type="submit" disabled>Export Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Ensure jQuery is loaded before any other scripts that use it -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var roles = @json($roles);
            const $akunPuskesmas = $('#akun_puskesmaspkp');
            if (roles == "admin puskesmas") {
                $('#pdf').prop('disabled', false);
                $('#excel').prop('disabled', false);

                // $("#akun_puskesmaspkp").on("input", function () {
                //     var akun_puskesmaspkp = $(this).val();
                //     if (akun_puskesmaspkp) {
                //         fetchYears(akun_puskesmaspkp);
                //         $("#pdf").prop("disabled", true);
                //         $("#excel").prop("disabled", true);
                //     } else {
                //         $("#pdf").prop("disabled", false);
                //         $("#excel").prop("disabled", false);
                //     }
                // });
                // $("#akun_puskesmaspkp").change(function () {
                //     var akun_puskesmaspkp = $(this).val();

                //     if (akun_puskesmaspkp) {
                //         toggleElements(true);
                //         fetchYears(akun_puskesmaspkp);
                //     } else {
                //         toggleElements(false);
                //     }
                // });
            }else{
                $('#tahunpkp').prop('disabled', false);
                $("#jenis_indikatorpkp").on("input", function () {
                    var tahunpkp = $(this).val();
                    console.log(tahunpkp);
                    if (tahunpkp) {
                        $("#pdf").prop("disabled", true);
                        $("#excel").prop("disabled", true);
                    } else {
                        $("#pdf").prop("disabled", false);
                        $("#excel").prop("disabled", false);
                    }
                });

            }



            const $tahun = $('#tahunpkp');
            const $bulan = $('#bulanpkp');
            const $jenisIndikator = $('#jenis_indikatorpkp');
            const $buttonPilih = $('#buttonpilikpkp');

            // Atur event listener untuk akun_puskesmas jika ada
            if ($akunPuskesmas.length) {
                $akunPuskesmas.on('change', function() {
                    $tahun.prop('disabled', false).focus(); // Fokus ke tahun setelah akun puskesmas dipilih
                    var akun_puskesmaspkp = $(this).val();
                    if (akun_puskesmaspkp) {
                        $("#pdf").prop("disabled", true);
                        $("#excel").prop("disabled", true);
                    } else {
                        $("#pdf").prop("disabled", false);
                        $("#excel").prop("disabled", false);
                    }
                });
            }

            // Event listener untuk tahun
            $tahun.on('change', function() {
                $bulan.prop('disabled', false).focus(); // Fokus ke bulan setelah tahun dipilih
            });

            // Event listener untuk bulan
            $bulan.on('change', function() {
                $jenisIndikator.prop('disabled', false).focus(); // Fokus ke jenis indikator setelah bulan dipilih
            });

            // Event listener untuk jenis indikator
            $jenisIndikator.on('change', function() {
                $buttonPilih.prop('disabled', false); // Aktifkan tombol setelah jenis indikator dipilih
                let indikator = $(this).val();
                if (indikator) {
                    $("#pdf").prop("disabled", false);
                    $("#excel").prop("disabled", false);
                } else {
                    $("#pdf").prop("disabled", true);
                    $("#excel").prop("disabled", true);
                }
            });
        });

    </script>

@endsection
