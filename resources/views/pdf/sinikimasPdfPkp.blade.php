<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pencapaian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6bY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 5.4pt;
            text-align: center;
        }

        @page {
            size: landscape;
        }

        /* Define header styles */
        @page {
            header: page-header;
        }

        /* Define footer styles */
        @page {
            footer: page-footer;
        }

        /* Style for header */
        #page-header {
            position: fixed;
            left: 0;
            top: -50px;
            /* Adjust as needed */
            right: 0;
            height: 50px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        /* Style for footer */
        #page-footer {
            position: fixed;
            left: 0;
            bottom: -50px;
            /* Adjust as needed */
            right: 0;
            height: 50px;
            text-align: center;
            border-top: 1px solid #ccc;
        }
    </style>

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

        @foreach ($sinikimas as $index => $data)
            @php
                // $result = collect($results)->firstWhere('id', $data->id);
                // $sub_variabel = $result['sub_variabel'] ?? '-';
                // $result_percent = $result['result_percent'] ?? '-';
                // $target_1 = $result['target_1'] ?? '-';

                if ($prevJenisCakupan !== $data->jenis_cakupan) {
                    $i = 1; // Reset nomor urutan
                    $prevJenisCakupan = $data->jenis_cakupan;
                }

                $averageValueindikator = isset(
                    $structured_data[$data->jenis_cakupan][$data->jenis_indikator]['nilai_rata_indikator'],
                )
                    ? $structured_data[$data->jenis_cakupan][$data->jenis_indikator]['nilai_rata_indikator']
                    : 'N/A';

                // Default nilai_rata_subindikator
                $averageValuesubindikator = 'N/A';

                // Loop melalui sub_indikators untuk menemukan subindikator yang sesuai
                if (isset($structured_data[$data->jenis_cakupan][$data->jenis_indikator]['sub_indikators'])) {
                    foreach (
                        $structured_data[$data->jenis_cakupan][$data->jenis_indikator]['sub_indikators']
                        as $subindikator
                    ) {
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
                    if ($akun_puskesmas !== 'all') {
                        echo '<tr><td colspan="13" style="text-align: center; font-size: 14px;">';
                        echo 'PENILAIAN KINERJA PUSKESMAS ' . ($data->akun_puskesmas ?? '......');
                        echo '</td></tr>';
                    }
                    if ($tahun) {
                        echo '<tr><td colspan="13" style="text-align: center; font-size: 14px;">';
                        echo 'BULAN ' . ($data->bulan ?? '.....') . ' TAHUN ' . ($data->tahun ?? '.....');
                        echo '</td></tr>';
                    }
                    echo '<tr><td colspan="13" style="text-align: center; font-size: 14px; font-weight: bold;">';
                    echo 'PENILAIAN CAKUPAN KEGIATAN - ' . ($data->jenis_cakupan ?? '......');
                    echo '</td></tr>';
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
                        </tr>
                        <tr>
                            <th style="text-align: center;">Variabel</th>
                            <th style="text-align: center;">Sub Variabel</th>
                        </tr>';
                    $firstPage = false;
                @endphp

                <tr>
                    <td colspan="9" style="background-color: #248501; text-align: left; font-weight: bold;">
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
                    <td colspan="8" style="background-color: #f6b26b; text-align: left;">
                        {{ $data->jenis_indikator ?? '-' }}
                    </td>
                    <td style="background-color: #f6b26b;"></td>
                    <td style="background-color: #f6b26b;">{{ $averageValueindikator }}%</td>
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
                    <td colspan="8" style="background-color: #f6b26b; text-align: left;">
                        {{ $data->jenis_subindikator ?? '-' }}
                    </td>
                    <td style="background-color: #f6b26b;"></td>
                    <td style="background-color: #f6b26b;">{{$averageValuesubindikator}}%</td>
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
                {{-- <td>{{ isset($sub_variabel) ? number_format($sub_variabel, 2) . '%' : '-' }}</td> --}}
                {{-- <td>{{ $result_percent ?? '-' }}%</td> --}}
            </tr>
        @endforeach
    </table>
</body>

</html>
