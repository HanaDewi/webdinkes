@extends('kerangka.master')
@section('content')
    <!-- Basic Tables start -->
    <style>
        table tr td,
        table tr th {
            text-align: center;
            color: black;
        }
    </style>
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">INPUT DATA PKP</h4>
                    </div>
                    <div class="d-flex justify-content-start align-items-center p-2">
                        @if (auth()->user()->role == 'admin puskesmas')
                            <a class="btn btn-primary me-2" href="{{ route('pkp.create_pkp') }}"
                                style="width: 170px;">Tambah</a>
                        @endif
                        <form action="{{ route('pkp.filterpkp') }}" method="GET" class="d-flex">
                            @if (auth()->user()->role == 'admin puskesmas')
                            <select id="akun_puskesmaspkp" name="akun_puskesmas" class="form-control ms-2"
                                style="width: 150px;" >
                                <option value="" disabled selected>Akun Puskesmas</option>
                                @foreach ($akun_puskesmas as $value)
                                    <option value="{{ $value->akun_puskesmas }}">{{ $value->akun_puskesmas }}</option>
                                @endforeach
                            </select>
                            @endif
                            <select id="tahunpkp" name="tahun" class="form-control ms-2" style="width: 150px;" disabled>
                                <option value="" disabled selected>Tahun</option>
                            </select>
                            <select id="bulanpkp" name="bulan" class="form-control ms-2" style="width: 150px;" disabled>
                                <option value="" disabled selected>Bulan</option>
                            </select>

                            <select id="jenis_cakupanpkp" name="jenis_cakupan" class="form-control ms-2"
                                style="width: 150px;" disabled>
                                <option value="" disabled selected>Jenis Cakupan</option>
                            </select>
                            <select id="jenis_indikatorpkp" name="jenis_indikator" class="form-control ms-2"
                                style="width: 150px;" disabled>
                                <option value="" disabled selected>Indikator</option>
                            </select>

                            <select id="jenis_subindikatorpkp" name="jenis_subindikator" class="form-control ms-2"
                                style="width: 150px;" disabled>
                                <option value="" disabled selected>Subindikator</option>
                            </select>

                            <button id="buttonpilikpkp" type="submit" class="btn btn-primary ms-2" style="width: 120px;"
                                disabled>OKE PILIH</button>
                        </form>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with no outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    @php
                                        $i = 1;
                                        $noJudul = 1;
                                        $alphabet = 'A';
                                        $currentJenisCakupan = null;
                                        $currentJenisIndikator = null;
                                        $currentJenisSubindikator = null;
                                        $prevJenisCakupan = null;
                                        $firstPage = true;
                                    @endphp

                                    @foreach ($pkps as $index => $data)
                                        @php
                                            if ($prevJenisCakupan !== $data->jenis_cakupan) {
                                                $i = 1; // Reset nomor urutan
                                                $prevJenisCakupan = $data->jenis_cakupan;
                                            }
                                        @endphp
                                        @php
                                            $averageValueindikator = isset($structured_data[$data->jenis_cakupan][$data->jenis_indikator]['nilai_rata_indikator']) ? $structured_data[$data->jenis_cakupan][$data->jenis_indikator]['nilai_rata_indikator'] : 'N/A';

                                            // Default nilai_rata_subindikator
                                            $averageValuesubindikator = 'N/A';

                                            // Loop melalui sub_indikators untuk menemukan subindikator yang sesuai
                                            if (isset($structured_data[$data->jenis_cakupan][$data->jenis_indikator]['sub_indikators'])) {
                                                foreach ($structured_data[$data->jenis_cakupan][$data->jenis_indikator]['sub_indikators'] as $subindikator) {
                                                    if ($subindikator['jenis_subindikator'] === $data->jenis_subindikator) {
                                                        $averageValuesubindikator = $subindikator['nilai_rata_subindikator'];
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp

                                        @if ($currentJenisCakupan !== $data->jenis_cakupan)
                                            @php
                                                $currentJenisCakupan = $data->jenis_cakupan;
                                                $currentJenisIndikator = null;
                                                $currentJenisSubindikator = null;
                                                if (!$firstPage) {
                                                    echo '</table><table class="table table-bordered" style="page-break-before: always;">';
                                                }
                                                // echo '<tr><td colspan="14" style="text-align: center; font-size: 14px; font-weight: bold;">';
                                                // echo 'PENILAIAN CAKUPAN KEGIATAN - ' .
                                                //     ($data->jenis_cakupan ?? '......');
                                                // echo '</td></tr>';
                                                echo '<tr>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center;">No</th>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Upaya Kesehatan</th>
                                                <th colspan="2" style="vertical-align: middle; text-align: center;" rowspan="2">Kegiatan</th>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Satuan</th>
                                                <th colspan="4" style="vertical-align: middle; text-align: center;" rowspan="2">Target sasaran</th>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Pencapaian</th>
                                                <th colspan="2" style="text-align: center;">Cakupan</th>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Nilai</th>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Komentar</th>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Actions</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">Variabel</th>
                                                <th style="text-align: center;">Sub Variabel</th>
                                            </tr>';
                                                $firstPage = false;
                                            @endphp








                                            <tr>
                                                <td colspan="10"
                                                    style="background-color: #248501; text-align: left; font-weight: bold;">
                                                    {{ $data->jenis_cakupan ?? '-' }}
                                                </td>
                                                <td style="background-color: #248501;"></td>
                                                <td style="background-color: #248501;"></td>
                                                <td style="background-color: #248501;"></td>
                                                <td style="background-color: #248501;"></td>
                                                <td style="background-color: #248501;"></td>
                                            </tr>
                                        @endif

                                        @if ($currentJenisIndikator !== $data->jenis_indikator)
                                            @php
                                                $currentJenisIndikator = $data->jenis_indikator;
                                                $currentJenisSubindikator = null;
                                            @endphp
                                            <tr>
                                                <td style="background-color: #f6b26b;">{{ $noJudul++ }}</td>
                                                <td colspan="9" style="background-color: #f6b26b; text-align: left;">
                                                    {{ $data->jenis_indikator ?? '-' }}
                                                </td>
                                                <td style="background-color: #f6b26b;">{{ $averageValueindikator.'%' }}</td>
                                                <td style="background-color: #f6b26b;"></td>
                                                <td style="background-color: #f6b26b;"></td>
                                                <td style="background-color: #f6b26b;"></td>
                                                <td style="background-color: #f6b26b;"></td>
                                            </tr>
                                        @endif

                                        @if ($currentJenisSubindikator !== $data->jenis_subindikator)
                                            @php
                                                $currentJenisSubindikator = $data->jenis_subindikator;
                                            @endphp
                                            <tr>
                                                <td style="background-color: #f6b26b;">{{ $alphabet++ }}</td>
                                                <td colspan="9" style="background-color: #f6b26b; text-align: left;">
                                                    {{ $data->jenis_subindikator ?? '-' }}
                                                </td>
                                                <td style="background-color: #f6b26b;">{{$averageValuesubindikator.'%'}}</td>
                                                <td style="background-color: #f6b26b;"></td>
                                                <td style="background-color: #f6b26b;"></td>
                                                <td style="background-color: #f6b26b;"></td>
                                                <td style="background-color: #f6b26b;"></td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $data->kegiatan ?? '-' }}</td>
                                            <td>{{ $data->satuan ?? '-' }}</td>
                                            <td>{{ $data->target_1 ?? '-' }}</td>
                                            <td>{{ $data->target_2 ?? '-' }}</td>
                                            <td>{{ $data->target_persen ?? '-' }}%</td>
                                            <td>{{ $data->target_des ?? '-' }}</td>
                                            <td>{{ $data->pencapaian ?? '-' }}</td>
                                            <td>{{ $data->cakupan_variabel ?? '-' }}</td>
                                            <td>{{ $data->sub_variabel.'%' ?? '-' }}</td>
                                            <td>{{ $data->nilai.'%' ?? '-' }}</td>
                                            <td>{{ $data->komentar ?? '-' }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'admin puskesmas')
                                                    <div class="con d-flex">
                                                        <button type="button" class="btn btn-success"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal{{ $data->id }}">✔</button>
                                                        <a class="btn btn-warning mx-1"
                                                            href="{{ route('pkp.edit', $data->id) }}">Update</a>
                                                            <a class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')"
                                                            href="{{ route('pkp.delete', $data->id) }}">Delete</a>
                                                        </div>
                                                        @else
                                                        {{-- <button type="submit" class="btn btn-success">✔</button> --}}
                                                        <a class="btn btn-warning mx-1"
                                                            href="{{ route('pkp.edit', $data->id) }}">Update</a>
                                                @endif
                                                        <div class="modal fade" id="modal{{ $data->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Komentar</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <textarea name="komentar" id="komentar-field-{{ $data->id }}" class="form-group komentar-field" cols="30" rows="10">{{ $data->komentar }}</textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary" onclick="updateKomentar({{ $data->id }})">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
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
            $('#buttonpilikpkp').prop('disabled', false);

            if(roles == "admin puskesmas" ){
                console.log("ini admin")
                $('#akun_puskesmaspkp').on('input', function() {
                var akun_puskesmaspkp = $(this).val();
                console.log(akun_puskesmaspkp)
                if (akun_puskesmaspkp) {
                    fetchYears(akun_puskesmaspkp);
                    $('#buttonpilikpkp').prop('disabled', true);
                } else {
                    $('#buttonpilikpkp').prop('disabled', false);
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
                            '<option value="" disabled selected>Bulan</option>');
                        $('#jenis_cakupanpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Jenis Cakupan</option>');
                        $('#jenis_indikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Indikator</option>');
                        $('#jenis_subindikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Sub Indikator</option>');
                        $('#buttonpilikpkp').prop('disabled', true);

                    } else {
                        $('#tahunpkp').prop('disabled', true).html('<option value="" disabled selected>Tahun</option>');
                        $('#bulanpkp').prop('disabled', true).html('<option value="" disabled selected>Bulan</option>');
                        $('#jenis_cakupanpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Jenis Cakupan</option>');
                        $('#jenis_indikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Indikator</option>');
                        $('#jenis_subindikatorpkp').prop('disabled', true).html(
                            '<option value="" disabled selected>Sub Indikator</option>');
                        $('#buttonpilikpkp').prop('disabled', true);

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
                    $('#buttonpilikpkp').prop('disabled', true);
                } else {
                    $('#buttonpilikpkp').prop('disabled', false);
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
                        '<option value="" disabled selected>Jenis Cakupan</option>');
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Sub Indikator</option>');
                    $('#buttonpilikpkp').prop('disabled', true);

                } else {
                    $('#bulanpkp').prop('disabled', true).html('<option value="" disabled selected>Bulan</option>');
                    $('#jenis_cakupanpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Jenis Cakupan</option>');
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Sub Indikator</option>');
                    $('#buttonpilikpkp').prop('disabled', true);

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
                        '<option value="" disabled selected>Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Sub Indikator</option>');
                    $('#buttonpilikpkp').prop('disabled', true);

                } else {
                    $('#buttonpilikpkp').prop('disabled', true);
                    $('#jenis_cakupanpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Jenis Cakupan</option>');
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Sub Indikator</option>');
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
                        '<option value="" disabled selected>Sub Indikator</option>');
                    $('#buttonpilikpkp').prop('disabled', true);

                } else {
                    $('#buttonpilikpkp').prop('disabled', true);
                    $('#jenis_indikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Indikator</option>');
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Sub Indikator</option>');
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
                    $('#buttonpilikpkp').prop('disabled', true);

                } else {
                    $('#buttonpilikpkp').prop('disabled', true);
                    $('#jenis_subindikatorpkp').prop('disabled', true).html(
                        '<option value="" disabled selected>Sub Indikator</option>');
                }
            }
            $('#jenis_subindikatorpkp').change(function() {
                var jenisSubindikator = $(this).val();
                if (jenisSubindikator) {
                    $('#buttonpilikpkp').prop('disabled', false);
                } else {
                    $('#buttonpilikpkp').prop('disabled', true);
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
                        var options = '<option value="" disabled selected>Tahun</option>';
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
                        var options = '<option value="" disabled selected>Bulan</option>';
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
                        var options = '<option value="" disabled selected>Jenis Cakupan</option>';
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
                        var options = '<option value="" disabled selected>Indikator</option>';
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
                        var options = '<option value="" disabled selected>Sub Indikator</option>';
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

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript Function -->
    <script>
        function updateKomentar(id) {
            var komentar = $('#komentar-field-' + id).val();

            $.ajax({
                url: '{{ route('pkp.komentar') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    komentar: komentar
                },
                success: function(response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        window.location.href = response.redirect_url;
                    }else{
                        window.location.href = response.redirect_url;

                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating komentar:', error);
                    alert('Terjadi kesalahan saat memperbarui komentar.');
                }
            });
        }
    </script>
@endsection
