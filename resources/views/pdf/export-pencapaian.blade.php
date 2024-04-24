{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pencapaian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php dd($pencapaians); ?>
    <h1>Data Pencapaian</h1>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Program</th>
                <th>Indikator Kinerja</th>
                <th>Tipe</th>
                <th>Target</th>
                <th>Realisasi Januari</th>
                <th>Realisasi Februari</th>
                <th>Realisasi Maret</th>
                <th>Realisasi April</th>
                <th>Realisasi Mei</th>
                <th>Realisasi Juni</th>
                <th>Realisasi Juli</th>
                <th>Realisasi Agustus</th>
                <th>Realisasi September</th>
                <th>Realisasi Oktober</th>
                <th>Realisasi November</th>
                <th>Realisasi Desember</th>
                <th>Realisasi Akhir</th>
                <th>Definisi Operasional</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pencapaians as $pencapaian)
            <tr>
                <td>{{ $pencapaian->kode }}</td>
                <td>{{ $pencapaian->program }}</td>
                <td>{{ $pencapaian->indikator_kinerja }}</td>
                <td>{{ $pencapaian->tipe }}</td>
                <td>{{ $pencapaian->target }}%</td>
                <td>{{ $pencapaian->realisasi_januari }}%</td>
                <td>{{ $pencapaian->realisasi_februari }}%</td>
                <td>{{ $pencapaian->realisasi_maret }}%</td>
                <td>{{ $pencapaian->realisasi_april }}%</td>
                <td>{{ $pencapaian->realisasi_mei }}%</td>
                <td>{{ $pencapaian->realisasi_juni }}%</td>
                <td>{{ $pencapaian->realisasi_juli }}%</td>
                <td>{{ $pencapaian->realisasi_agustus }}%</td>
                <td>{{ $pencapaian->realisasi_september }}%</td>
                <td>{{ $pencapaian->realisasi_oktober }}%</td>
                <td>{{ $pencapaian->realisasi_november }}%</td>
                <td>{{ $pencapaian->realisasi_desember }}%</td>
                <td>{{ $pencapaian->realisasi_akhir }}%
                    @if($pencapaian->realisasi_akhir != 0)
                        <span class="text-success">verified</span>
                    @endif
                </td>
                <td>{{ $pencapaian->definisi_operasional }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> --}}
