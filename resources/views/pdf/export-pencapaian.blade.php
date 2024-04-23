<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Realisasi Program</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin-left: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-right: 10px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000000;
                text-align: left;
                padding: 3px;
                font-size: 11px; 
            }
            th {
                background-color: #f2f2f2;
            }
            p {
                font-size: 12px; 
            }

            td.no-l-border{
                border-left: none;
            }

            td.no-r-border{
                border-right: none;
            }

            td.no-b-border{
                border-bottom: none;
            }

            td.no-top-border{
                border-top: none;
            }

            td.no-border, th.no-border {
                border: none;
                background-color: #ffffff;
            }

            .center {
                text-align: center;
            }

            .bold {
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <h2 style="text-align: center;">Realisasi Porgram</h2>
        <p>Tahun: {{ $tahun }}</p> 
        <p>Capaian: {{ $keg }}</p> 
        {{-- <p>Tahapan APBD: {{ $apbd }}</p>  --}}
        <table>
            <tr>
                <th width="5%" rowspan="2" class="center">No</th>
                <th width="50%" rowspan="2" class="center">Kode</th>
                <th width="50%" rowspan="2" class="center">Program</th>
                <th width="50%" rowspan="2" class="center">Indikator Kinerja</th>
                <th width="50%" rowspan="2" class="center">Tipe</th>
                <th width="50%" rowspan="2" class="center">Target</th>
                <th width="50%" colspan="12" class="center">Realisasi</th>
                <th width="50%" rowspan="2" class="center">Realisasi Akhir</th>
                <th width="50%" rowspan="2" class="center">Definisi Operasional</th>
            </tr>
            <tr>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
            </tr>
            @foreach($pencapaians as $pencapaian => $data)
            <tr>
                <td>{{ $pencapaian + 1 }}</td>
                <td>{{ $data->kode }}</td>
                <td>{{ $data->program }}</td>
                <td>{{ $data->indikator }}</td>
                <td>{{ $data->tipe }}</td>
                <td>{{ $data->target }}</td>
                <!-- Loop through realisasi data for each month -->
                @foreach($data->realisasi as $realisasi)
                <td>{{ $data->realisasi_maret }}</td>
                <td>{{ $data->realisasi_april }}</td>
                <td>{{ $data->realisasi_mei }}</td>
                <td>{{ $data->realisasi_juni }}</td>
                <td>{{ $data->realisasi_juli }}</td>
                <td>{{ $data->realisasi_agustus }}</td>
                <td>{{ $data->realisasi_september }}</td>
                <td>{{ $data->realisasi_oktober }}</td>
                <td>{{ $data->realisasi_november }}</td>
                <td>{{ $data->realisasi_desember }}</td>
                <td>{{ $data->realisasi_akhir }}</td>
                <td>{{ $data->definisi_operasional }}</td>
                @endforeach
                <td>{{ $data->realisasi_akhir }}</td>
                <td>{{ $data->definisi_operasional }}</td>
            </tr>
            @endforeach
            </table>
        </div>
    </body>
</html>