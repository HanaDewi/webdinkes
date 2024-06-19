<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pencapaian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 6pt;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table-bordered td:first-child,
        .table-bordered th:first-child,
        .table-borderless td:first-child {
            text-align: left;
        }

        .table-borderless td,
        .table-borderless th {
            text-align: left;
            padding-right: 10px;
        }

        .table {
            table-layout: fixed;
            width: 100%;
        }

        th, td {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .break-word {
            white-space: normal;
            word-wrap: break-word;
            word-break: break-all;
        }

        @page {
            size: landscape;
            margin: 10mm;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
    <center>
        <h4>Laporan Pencapaian</h4>
    </center>

    <div class="container mt-4 mb-4">
        <table class="table table-borderless">
            <tr>
                <td style="padding-right: 10px; width: 20%;">Nama Akun</td>
                <td style="width: 80%;">: {{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <td style="padding-right: 10px; width: 20%;">Bulan</td>
                <td style="width: 80%;">: {{ ucfirst($bulan) }}</td>
            </tr>
            <tr>
                <td style="padding-right: 10px; width: 20%;">Tahun</td>
                <td style="width: 80%;">: {{ request('tahun') }}</td>
            </tr>
            <tr>
                <td style="padding-right: 10px; width: 20%;">Capaian</td>
                <td style="width: 80%;">: {{ request('keg') }}</td>
            </tr>
            <tr>
                <td style="padding-right: 10px; width: 20%;">Tahapan APBD</td>
                <td style="width: 80%;">: {{ request('apbd') }}</td>
            </tr>
        </table>
    </div>
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 10%;">Kode</th>
                <th class="break-word" style="width: 15%;">Program</th>
                <th style="width: 10%;">Indikator Kinerja</th>
                <th style="width: 13%;">Tipe</th>
                <th style="width: 5%;">Target</th>
                @if($bulan == 'all')
                    <th style="width: 5%;">Jan</th>
                    <th style="width: 5%;">Feb</th>
                    <th style="width: 5%;">Mar</th>
                    <th style="width: 5%;">Apr</th>
                    <th style="width: 5%;">Mei</th>
                    <th style="width: 5%;">Jun</th>
                    <th style="width: 5%;">Jul</th>
                    <th style="width: 5%;">Agu</th>
                    <th style="width: 5%;">Sep</th>
                    <th style="width: 5%;">Okt</th>
                    <th style="width: 5%;">Nov</th>
                    <th style="width: 5%;">Des</th>
                @else
                    <th style="width: 10%;">Realisasi {{ ucfirst($bulan) }}</th>
                @endif
                <th style="width: 8%;">Realisasi Akhir</th>
                <th style="width: 10%;">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($pencapaians as $p)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$p['kode']}}</td>
                <td class="break-word">{{$p['program']}}</td>
                <td>{{$p['indikator_kinerja']}}</td>
                <td>{{$p['tipe']}}</td>
                <td>{{$p['target']}} %</td>
                @if($bulan == 'all')
                    <td>{{$p['realisasi_januari']}}</td>
                    <td>{{$p['realisasi_februari']}}</td>
                    <td>{{$p['realisasi_maret']}}</td>
                    <td>{{$p['realisasi_april']}}</td>
                    <td>{{$p['realisasi_mei']}}</td>
                    <td>{{$p['realisasi_juni']}}</td>
                    <td>{{$p['realisasi_juli']}}</td>
                    <td>{{$p['realisasi_agustus']}}</td>
                    <td>{{$p['realisasi_september']}}</td>
                    <td>{{$p['realisasi_oktober']}}</td>
                    <td>{{$p['realisasi_november']}}</td>
                    <td>{{$p['realisasi_desember']}}</td>
                @else
                    <td>{{$p['realisasi_bulan']}}</td>
                @endif
                <td>{{$p['realisasi_akhir']}}%</td>
                <td>{{$p['komentar']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
