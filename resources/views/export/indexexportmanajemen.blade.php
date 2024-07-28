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
                    <form method="GET" action="{{ route('export.sinikimas2') }}">
                        <div class="card-body">
                            @if (auth()->user()->role == 'admin puskesmas')
                            <div class="form-group row">
                                <label for="akun_puskesmaspkp" class="col-form-label">Pilih Akun Puskesmas</label>
                                <select name="akun_puskesmas" id="akun_puskesmaspkp" class="form-select">
                                    <option value="" disabled selected>Pilih Akun</option>
                                    @foreach ($akun_puskesmas as $akun)
                                            <option value="{{ $akun->akun_puskesmas }}">{{ $akun->akun_puskesmas }}</option>

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label for="tahunpkp" class="col-form-label">Pilih Tahun</label>
                                <select name="tahun" id="tahunpkp" class="form-select" disabled>
                                    <option value="" disabled selected>Pilih Tahun</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="bulanpkp" class="col-form-label">Pilih Bulan</label>
                                <select name="bulan" id="bulanpkp" class="form-select" disabled>
                                    <option value="" disabled selected>Pilih Bulan</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_cakupanpkp" class="col-form-label">Pilih Jenis Cakupan</label>
                                <select name="jenis_cakupan" id="jenis_cakupanpkp" class="form-select" disabled>
                                    <option value="" disabled selected>Pilih Cakupan</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_indikatorpkp" class="col-form-label">Pilih Jenis Indikator</label>
                                <select name="jenis_indikator" id="jenis_indikatorpkp" class="form-select" disabled>
                                    <option value="" disabled selected>Pilih Indikator</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_subindikatorpkp" class="col-form-label">Pilih Jenis Subindikator</label>
                                <select name="jenis_subindikator" id="jenis_subindikatorpkp" class="form-select" disabled>
                                    <option value="" disabled selected>Pilih Subindikator</option>
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
        var akun_puskesmasss = @json($akun_puskesmas);
            $('#pdf').prop('disabled', false);
            $('#excel').prop('disabled', false);

            if(roles == "admin puskesmas" ){
                console.log("ini admin")
                $('#akun_puskesmaspkp').on('input', function() {
                var akun_puskesmaspkp = $(this).val();
                console.log(akun_puskesmaspkp)
                if (akun_puskesmaspkp) {
                    fetchYears(akun_puskesmaspkp);
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);
                } else {
                    $('#pdf').prop('disabled', false);
                    $('#excel').prop('disabled', false);
                }
                });
                $('#akun_puskesmaspkp').change(function() {
                    var akun_puskesmaspkp = $(this).val();

                    if (akun_puskesmaspkp) {
                        toggleElements(true);
                        fetchYears(akun_puskesmaspkp);
                    } else {
                        toggleElements(false);
                    }
                });
                function toggleElements(isEnabled) {
                    if (isEnabled) {
                        $('#tahunpkp').prop('disabled',false);
                        $('#bulanpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Pilih Bulan</option>');
                        $('#jenis_cakupanpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Pilih Cakupan</option>');
                        $('#jenis_indikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Pilih Indikator</option>');
                        $('#jenis_subindikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Pilih Subindikator</option>');
                        $('#pdf').prop('disabled', true);
                        $('#excel').prop('disabled', true);

                    } else {
                        $('#tahunpkp').prop('disabled', true).html('<option value="" disabled selected>Pilih Tahun</option>');
                        $('#bulanpkp').prop('disabled', true).html('<option value="" disabled selected>Pilih Bulan</option>');
                        $('#jenis_cakupanpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Pilih Cakupan</option>');
                        $('#jenis_indikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Pilih Indikator</option>');
                        $('#jenis_subindikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Pilih Subindikator</option>');
                        $('#pdf').prop('disabled', true);
                        $('#excel').prop('disabled', true);

                    }
                }
            }else{
                console.log("bukan admin")
                fetchYears(akun_puskesmasss);
                $('#tahunpkp').prop('disabled',false);

                 $('#tahunpkp').on('input', function() {
                var tahunpkp = $(this).val();
                console.log(tahunpkp)
                if (tahunpkp) {
                    fetchMonths(akun_puskesmasss,tahunpkp);
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);
                } else {
                    $('#pdf').prop('disabled', false);
                    $('#excel').prop('disabled', false);
                }
                });
                
            }
            $('#tahunpkp').change(function() {
                var tahunpkp = $(this).val();
                

                if (tahunpkp) {
                    toggleElementsyear(true);
                    fetchMonths(akun_puskesmasss,tahunpkp);
                } else {
                    toggleElementsyear(false);
                }
            });
            function toggleElementsyear(isEnabled) {
                if (isEnabled) {
                    $('#bulanpkp').prop('disabled',false);
                    $('#jenis_cakupanpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Cakupan</option>');
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Subindikator</option>');
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);

                } else {
                    $('#bulanpkp').prop('disabled', true).html('<option value="" disabled selected>Pilih Bulan</option>');
                    $('#jenis_cakupanpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Cakupan</option>');
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Subindikator</option>');
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);

                }
            }

            

            
            $('#bulanpkp').change(function() {
                var bulan = $(this).val();
                var tahun = $('#tahunpkp').val();
                if (bulan) {
                    fetchJenisCakupan(akun_puskesmasss,tahun,bulan);
                    toggleElements2(true)
                } else {
                    toggleElements2(false)
                }
            });

            function toggleElements2(isEnabled) {
                if (isEnabled) {
                    $('#jenis_cakupanpkp').prop('disabled', false);
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Subindikator</option>');
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);

                } else {
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);
                    $('#jenis_cakupanpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Cakupan</option>');
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Subindikator</option>');
                }
            }
            $('#jenis_cakupanpkp').change(function() {
                var jenisCakupan = $(this).val();
                var tahun = $('#tahunpkp').val();
                var bulan = $('#bulanpkp').val();
                if (jenisCakupan) {
                    fetchJenisIndikator(akun_puskesmasss,tahun,bulan,jenisCakupan);
                    toggleElements3(true)
                } else {
                    toggleElements3(false)
                }
            });

            function toggleElements3(isEnabled) {
                if (isEnabled) {
                    $('#jenis_indikatorpkp').prop('disabled', false);
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Subindikator</option>');
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);

                } else {
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Subindikator</option>');
                }
            }
            $('#jenis_indikatorpkp').change(function() {
                var jenisIndikator = $(this).val();
                
                var tahun = $('#tahunpkp').val();
                var bulan = $('#bulanpkp').val();
                var jenisCakupan = $('#jenis_cakupanpkp').val();
                if (jenisIndikator) {
                    fetchJenisSubIndikator(akun_puskesmasss,tahun,bulan,jenisCakupan,jenisIndikator);
                    toggleElements4(true);
                } else {
                    toggleElements4(false)
                }
            });

            function toggleElements4(isEnabled) {
                if (isEnabled) {
                    $('#jenis_subindikatorpkp').prop('disabled', false);
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);

                } else {
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Pilih Subindikator</option>');
                }
            }
            $('#jenis_subindikatorpkp').change(function() {
                var jenisSubindikator = $(this).val();
                if (jenisSubindikator) {
                    $('#pdf').prop('disabled', false);
                    $('#excel').prop('disabled', false);
                } else {
                    $('#pdf').prop('disabled', true);
                    $('#excel').prop('disabled', true);
                }
            });



            function fetchYears(akun_puskesmas) {
                $.ajax({
                    url: '{{ route('tahun') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        akun_puskesmas: akun_puskesmas
                    },
                    success: function(data) {
                        var options = '<option value="" disabled selected>Pilih Tahun</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.tahun + '">' + value.tahun +
                                '</option>';
                        });
                        $('#tahunpkp').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching months:', error);
                    }
                });
            }
            function fetchMonths(akun_puskesmas,tahun) {
                $.ajax({
                    url: '{{ route('bulan') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        akun_puskesmas: akun_puskesmas,
                        tahun: tahun
                    },
                    success: function(data) {
                        var options = '<option value="" disabled selected>Pilih Bulan</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.bulan + '">' + value.bulan +
                                '</option>';
                        });
                        $('#bulanpkp').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching months:', error);
                    }
                });
            }

            function fetchJenisCakupan(akun_puskesmas,tahun,bulan) {
                $.ajax({
                    url: '{{ route('jenis_cakupan') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        akun_puskesmas: akun_puskesmas,
                        tahun: tahun,
                        bulan: bulan
                    },
                    success: function(data) {
                        var options = '<option value="" disabled selected>Pilih Cakupan</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.jenis_cakupan + '">' + value
                                .jenis_cakupan + '</option>';
                        });
                        $('#jenis_cakupanpkp').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching jenis cakupan:', error);
                    }
                });
            }

            function fetchJenisIndikator(akun_puskesmas,tahun,bulan,jenisCakupan) {
                $.ajax({
                    url: '{{ route('jenis_indikator') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        akun_puskesmas: akun_puskesmas,
                        tahun: tahun,
                        bulan: bulan,
                        jenis_cakupan: jenisCakupan
                    },
                    success: function(data) {
                        var options = '<option value="" disabled selected>Pilih Indikator</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.jenis_indikator + '">' + value
                                .jenis_indikator + '</option>';
                        });
                        $('#jenis_indikatorpkp').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching jenis indikator:', error);
                    }
                });
            }

            function fetchJenisSubIndikator(akun_puskesmas,tahun,bulan,jenisCakupan,jenisIndikator) {
                $.ajax({
                    url: '{{ route('jenis_subindikator') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        akun_puskesmas: akun_puskesmas,
                        tahun: tahun,
                        bulan: bulan,
                        jenis_cakupan: jenisCakupan,
                        jenis_indikator: jenisIndikator
                    },
                    success: function(data) {
                        var options = '<option value="" disabled selected>Pilih Subindikator</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.jenis_subindikator + '">' +
                                value.jenis_subindikator + '</option>';
                        });
                        $('#jenis_subindikatorpkp').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching jenis indikator:', error);
                    }
                });
            }
        });
    </script>
  
@endsection
