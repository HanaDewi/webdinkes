<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pencapaian</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 5.4pt;
            text-align: center;
		}


    @page {
        size: landscape;
    }

	</style>
	<center>
		<h5>Laporan Pencapaian</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Kode</th>
                <th rowspan="2">Program</th>
                <th rowspan="2">Indikator Kinerja</th>
                <th rowspan="2">Tipe</th>
                <th rowspan="2">Target</th>
                <th colspan="13">Realisasi</th>
             

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
                <th>Realisasi Akhir</th>
              </tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pencapaians as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->kode}}</td>
				<td>{{$p->program}}</td>
				<td>{{$p->indikator_kinerja}}</td>
				<td>{{$p->tipe}}</td>
				<td>{{$p->target}} %</td>
				<td>{{$p->realisasi_januari}}</td>
				<td>{{$p->realisasi_februari}}</td>
				<td>{{$p->realisasi_maret}}</td>
				<td>{{$p->realisasi_april}}</td>
				<td>{{$p->realisasi_mei}}</td>
				<td>{{$p->realisasi_juni}}</td>
				<td>{{$p->realisasi_juli}}</td>
				<td>{{$p->realisasi_agustus}}</td>
				<td>{{$p->realisasi_september}}</td>
				<td>{{$p->realisasi_oktober}}</td>
				<td>{{$p->realisasi_november}}</td>
				<td>{{$p->realisasi_desember}}</td>
				<td>{{$p->realisasi_akhir}}%</td>
				

			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
