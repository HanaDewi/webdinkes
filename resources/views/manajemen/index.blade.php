@extends('kerangka.master')
@section('content')
    <!-- Basic Tables start -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header-indikator {
            background-color: #d9d9d9;
            font-weight: bold;
        }

        .header-sub-indikator {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total-nilai {
            background-color: #f6b26b;
            font-weight: bold;
            text-align: right;
        }
    </style>
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">INPUT DATA Manajemen</h4>
                    </div>
                    <div class="d-flex justify-content-start align-items-center p-2">
                        <form action="{{ route('manajemen.filter') }}" method="GET" class="d-flex">
                            @if (auth()->user()->role == 'admin puskesmas')
                                <a class="btn btn-primary me-2" href="{{ route('manajemen.create') }}"
                                    style="width: 170px;">Tambah</a>
                            @endif
                            @if (auth()->user()->role == 'admin puskesmas')
                                <select id="akun_puskesmaspkp" name="akun_puskesmas" class="form-control ms-2"
                                    style="width: 150px;" tabindex="1">
                                    <option value="" disabled selected>Akun Puskesmas</option>
                                    @foreach ($akun_puskesmas as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if (auth()->user()->role == 'admin puskesmas')
                                <select id="tahunpkp" name="tahun" class="form-control ms-2" style="width: 150px;"
                                    tabindex="2" disabled>
                                    <option value="" disabled selected>Tahun</option>
                                    @foreach ($tahun as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select id="tahunpkp" name="tahun" class="form-control ms-2" style="width: 150px;"
                                    tabindex="2">
                                    <option value="" disabled selected>Tahun</option>
                                    @foreach ($tahun as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            @endif
                            <select id="bulanpkp" name="bulan" class="form-control ms-2" style="width: 150px;"
                                tabindex="3" disabled>
                                <option value="" disabled selected>Bulan</option>
                                @foreach ($bulan as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <select id="jenis_indikatorpkp" name="jenis_indikator" class="form-control ms-2"
                                style="width: 150px;" tabindex="4" disabled>
                                <option value="" selected>Indikator</option>
                                @foreach ($indikators as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <button id="buttonpilikpkp" type="submit" class="btn btn-primary ms-2" style="width: 120px;"
                                tabindex="5" disabled>OKE PILIH</button>
                        </form>

                    </div>

                    @if (session()->has('success'))
                        <div class="alert
                                alert-success alert-dismissible fade show"
                            role="alert">
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
                                @if (auth()->user()->role == 'admin puskesmas')
                                    @foreach ($data as $puskesmas => $data)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="background: #435ebe;color:white">
                                                    <th colspan="11"> Akun Puskesmas: {{ $puskesmas }}</th>
                                                </tr>
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2" colspan="2" class="text-center">Jenis Variabel
                                                    </th>
                                                    <th colspan="4" class="text-center">SKALA</th>
                                                    <th rowspan="2" class="text-center">Nilai Hasil</th>
                                                    <th rowspan="2" class="text-center">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Nilai 0</th>
                                                    <th class="text-center">Nilai 4</th>
                                                    <th class="text-center">Nilai 7</th>
                                                    <th class="text-center">Nilai 10</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $currentIndikator = '';
                                                    $currentSubIndikator = '';
                                                    $no = 1;
                                                    $totalNilaiHasil = 0;
                                                    $jumlahData = count($data);
                                                    $alphabet = 'A';

                                                @endphp

                                                @foreach ($data as $key => $item)
                                                    @if ($currentIndikator != $item['indikator'])
                                                        @php
                                                            $currentIndikator = $item['indikator'];
                                                            $no = 1;
                                                        @endphp
                                                        <tr>
                                                            <td colspan="9"></td>
                                                        </tr>
                                                        <tr style="background-color: #45ad00;color: white;">
                                                            <td colspan="9" class="header-indikator">
                                                                {{ $alphabet++ }}.
                                                                {{ $currentIndikator }}</td>
                                                        </tr>
                                                    @endif

                                                    @if ($currentSubIndikator != $item['sub_indikator'])
                                                        @php
                                                            $currentSubIndikator = $item['sub_indikator'];
                                                            $no = 1;
                                                            $alphabet_kecil = 'a';
                                                        @endphp
                                                        <tr style="background-color: #cadbbe;">
                                                            <td>{{ $no }}.</td>
                                                            <td colspan="8" class="header-sub-indikator">
                                                                {{ $currentSubIndikator }}</td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $alphabet_kecil++ }}</td>
                                                        <td>{{ $item['jenis_variabel'] }}</td>
                                                        <td>{{ $item['nilai_0'] }}</td>
                                                        <td>{{ $item['nilai_4'] }}</td>
                                                        <td>{{ $item['nilai_7'] }}</td>
                                                        <td>{{ $item['nilai_10'] }}</td>
                                                        <td>{{ $item['nilai_hasil'] }}</td>
                                                        <td>
                                                            @if (auth()->user()->role == 'admin puskesmas')
                                                                <div class="con d-flex">
                                                                    <a class="btn btn-warning mx-1"
                                                                        href="{{ route('manajemen.edit', ['id' => $item->id]) }}">Edit</a>
                                                                    <a class="btn btn-danger"
                                                                        onclick="return confirm('Apakah Anda Yakin?')"
                                                                        href="{{ route('manajemen.delete', ['id' => $item->id]) }}">Delete</a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    @php
                                                        $no++;
                                                        $totalNilaiHasil += $item['nilai_hasil'];
                                                    @endphp

                                                    @if ($key == $jumlahData - 1 || (isset($data[$key + 1]) && $data[$key + 1]['sub_indikator'] != $item['sub_indikator']))
                                                        <tr style="background-color: #f6b26b;">
                                                            <td colspan="7" class="total-nilai">TOTAL Nilai</td>
                                                            <td>
                                                                {{ round($totalNilaiHasil / ($no - 1)) }}

                                                            </td>
                                                            <td colspan="3"></td>
                                                        </tr>
                                                        @php
                                                            $totalNilaiHasil = 0;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2" colspan="2" class="text-center">Jenis Variabel</th>
                                                <th colspan="4" class="text-center">SKALA</th>
                                                <th rowspan="2" class="text-center">Nilai Hasil</th>
                                                <th rowspan="2" class="text-center">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Nilai 0</th>
                                                <th class="text-center">Nilai 4</th>
                                                <th class="text-center">Nilai 7</th>
                                                <th class="text-center">Nilai 10</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $currentIndikator = '';
                                                $currentSubIndikator = '';
                                                $no = 1;
                                                $totalNilaiHasil = 0;
                                                $jumlahData = count($data);
                                                $alphabet = 'A';

                                            @endphp

                                            @foreach ($data as $key => $item)
                                                @if ($currentIndikator != $item['indikator'])
                                                    @php
                                                        $currentIndikator = $item['indikator'];
                                                        $no = 1;
                                                    @endphp
                                                    <tr>
                                                        <td colspan="9"></td>
                                                    </tr>
                                                    <tr style="background-color: #45ad00;color: white;">
                                                        <td colspan="9" class="header-indikator">{{ $alphabet++ }}.
                                                            {{ $currentIndikator }}</td>
                                                    </tr>
                                                @endif

                                                @if ($currentSubIndikator != $item['sub_indikator'])
                                                    @php
                                                        $currentSubIndikator = $item['sub_indikator'];
                                                        $no = 1;
                                                        $alphabet_kecil = 'a';
                                                    @endphp
                                                    <tr style="background-color: #cadbbe;">
                                                        <td>{{ $no }}.</td>
                                                        <td colspan="8" class="header-sub-indikator">
                                                            {{ $currentSubIndikator }}</td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td></td>
                                                    <td>{{ $alphabet_kecil++ }}</td>
                                                    <td>{{ $item['jenis_variabel'] }}</td>
                                                    <td>{{ $item['nilai_0'] }}</td>
                                                    <td>{{ $item['nilai_4'] }}</td>
                                                    <td>{{ $item['nilai_7'] }}</td>
                                                    <td>{{ $item['nilai_10'] }}</td>
                                                    <td>{{ $item['nilai_hasil'] }}</td>
                                                    <td>
                                                        <div class="con d-flex">
                                                            <a class="btn btn-warning mx-1"
                                                                href="{{ route('manajemen.edit', ['id' => $item->id]) }}">Edit</a>

                                                        </div>
                                                    </td>
                                                </tr>

                                                @php
                                                    $no++;
                                                    $totalNilaiHasil += $item['nilai_hasil'];
                                                @endphp

                                                @if ($key == $jumlahData - 1 || (isset($data[$key + 1]) && $data[$key + 1]['sub_indikator'] != $item['sub_indikator']))
                                                    <tr style="background-color: #f6b26b;">
                                                        <td colspan="7" class="total-nilai">TOTAL Nilai</td>
                                                        <td>
                                                            {{ round($totalNilaiHasil / ($no - 1)) }}

                                                        </td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                    @php
                                                        $totalNilaiHasil = 0;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen select yang akan diatur
            const akunPuskesmas = document.getElementById('akun_puskesmaspkp');
            const tahun = document.getElementById('tahunpkp');
            const bulan = document.getElementById('bulanpkp');
            const jenisIndikator = document.getElementById('jenis_indikatorpkp');
            const buttonPilih = document.getElementById('buttonpilikpkp');

            // Atur event listener untuk akun_puskesmas jika ada
            if (akunPuskesmas) {
                akunPuskesmas.addEventListener('change', function() {
                    tahun.disabled = false;
                    tahun.focus(); // Fokus ke tahun setelah akun puskesmas dipilih
                });
            }

            // Event listener untuk tahun
            tahun.addEventListener('change', function() {
                bulan.disabled = false;
                bulan.focus(); // Fokus ke bulan setelah tahun dipilih
            });

            // Event listener untuk bulan
            bulan.addEventListener('change', function() {
                jenisIndikator.disabled = false;
                jenisIndikator.focus(); // Fokus ke jenis indikator setelah bulan dipilih
            });

            // Event listener untuk jenis indikator
            jenisIndikator.addEventListener('change', function() {
                buttonPilih.disabled = false; // Aktifkan tombol setelah jenis indikator dipilih
            });
        });
    </script>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript Function -->
@endsection
