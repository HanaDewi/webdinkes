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

    .header-indikator {
        font-weight: bold;
    }

    .header-sub-indikator {
        font-weight: bold;
    }

    .total-nilai {
        background-color: #f6b26b;
        font-weight: bold;
        text-align: right;
    }
</style>
<div class="table-responsive">
    @if (auth()->user()->role == 'admin puskesmas')
        @foreach ($data as $puskesmas => $data)
            <table class="table table-bordered">
                <tr><td colspan="13" style="text-align: center; font-size: 14px;">PENILAIAN KINERJA MANAGEMENT</td></tr>
                <tr><td colspan="13" style="text-align: center; font-size: 14px;">BULAN {{ $bulan[1] }} TAHUN {{ $tahun[1] }}</td></tr>
                <thead>
                    <tr>
                        <th colspan="8" style="background: #435ebe;color:white"> Akun Puskesmas: {{ $puskesmas }}</th>
                    </tr>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2" colspan="2" class="text-center">Jenis Variabel
                        </th>
                        <th colspan="4" class="text-center">SKALA</th>
                        <th rowspan="2" class="text-center">Nilai Hasil</th>
                        {{-- <th rowspan="2" class="text-center">Aksi</th> --}}
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
                                <td colspan="8"></td>
                            </tr>
                            <tr>
                                <td colspan="8" class="header-indikator" style="background-color: #45ad00;color: white;">
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
                            {{-- <td>
                                @if (auth()->user()->role == 'admin puskesmas')
                                    <div class="con d-flex">
                                        <a class="btn btn-warning mx-1"
                                            href="{{ route('manajemen.edit', ['id' => $item->id]) }}">Edit</a>
                                        <a class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda Yakin?')"
                                            href="{{ route('manajemen.delete', ['id' => $item->id]) }}">Delete</a>
                                    </div>
                                @endif
                            </td> --}}
                        </tr>

                        @php
                            $no++;
                            $totalNilaiHasil += $item['nilai_hasil'];
                        @endphp

                        @if ($key == $jumlahData - 1 || (isset($data[$key + 1]) && $data[$key + 1]['sub_indikator'] != $item['sub_indikator']))
                            <tr>
                                <td colspan="7" class="total-nilai" style="background-color: #f6b26b;">TOTAL Nilai</td>
                                <td style="background-color: #f6b26b;">
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
                <!-- Signature Row -->
                <tr></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3" style="vertical-align: middle; text-align: center;">
                        Jakarta, 27 Februari 2021
                    </td>
                </tr>
                <tr style="text-align: end;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3" style="vertical-align: middle; text-align: center">
                        Penanggung Jawab Puskesmas
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr style="text-align: end; margin-top: 10px">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3" style="vertical-align: middle; text-align: center;">
                        <strong>dr. Dwi Suryanto, M.Kes</strong>
                    </td>
                </tr>
                <tr style="text-align: end;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3" style="vertical-align: middle; text-align: center;">
                        <strong>NIP. 1234567890</strong>
                    </td>
                </tr>
                <!-- End Signature Row -->
            </table>
        @endforeach
    @else
        <table class="table table-bordered">
            <tr><td colspan="13" style="text-align: center; font-size: 14px;">PENILAIAN KINERJA MANAGEMENT</td></tr>
            <tr><td colspan="13" style="text-align: center; font-size: 14px;">BULAN {{ $bulan[1] }} TAHUN {{ $tahun[1] }}</td></tr>
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2" colspan="2" class="text-center">Jenis Variabel</th>
                    <th colspan="4" class="text-center">SKALA</th>
                    <th rowspan="2" class="text-center">Nilai Hasil</th>
                    {{-- <th rowspan="2" class="text-center">Aksi</th> --}}
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
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="8" class="header-indikator" style="background-color: #45ad00;color: white;">{{ $alphabet++ }}.
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
                        {{-- <td>
                            <div class="con d-flex">
                                <a class="btn btn-warning mx-1"
                                    href="{{ route('manajemen.edit', ['id' => $item->id]) }}">Edit</a>

                            </div>
                        </td> --}}
                    </tr>

                    @php
                        $no++;
                        $totalNilaiHasil += $item['nilai_hasil'];
                    @endphp

                    @if ($key == $jumlahData - 1 || (isset($data[$key + 1]) && $data[$key + 1]['sub_indikator'] != $item['sub_indikator']))
                        <tr>
                            <td colspan="7" class="total-nilai" style="background-color: #f6b26b;">TOTAL Nilai</td>
                            <td style="background-color: #f6b26b;">
                                {{ round($totalNilaiHasil / ($no - 1)) }}

                            </td style="background-color: #f6b26b;">
                            <td colspan="3"></td>
                        </tr>
                        @php
                            $totalNilaiHasil = 0;
                        @endphp
                    @endif
                @endforeach
            </tbody>
            <!-- Signature Row -->
            <tr></tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3" style="vertical-align: middle; text-align: center;">
                    Jakarta, 27 Februari 2021
                </td>
            </tr>
            <tr style="text-align: end;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3" style="vertical-align: middle; text-align: center;">
                    Penanggung Jawab Puskesmas
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr style="text-align: end;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3" style="vertical-align: middle; text-align: center;">
                    <strong>dr. Dwi Suryanto, M.Kes</strong>
                </td>
            </tr>
            <tr style="text-align: end;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3" style="vertical-align: middle; text-align: center;">
                    <strong>NIP. 1234567890</strong>
                </td>
            </tr>
            <!-- End Signature Row -->
        </table>
    @endif
</div>
