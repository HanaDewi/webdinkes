<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Data</h1>
    <hr>
    <table class="table table-striped">
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pencapaians as $pencapaian)
            @if(auth()->user()->role == 'user')
            <form action="{{route('pencapaian.submit.user',$pencapaian->id)}}" method="POST">
            @else
            <form action="{{route('pencapaian.submit.admin',$pencapaian->id)}}" method="POST">
            @endif
            @csrf
            <tr>
                
                <td>{{ $pencapaian->kode }}</td>
                <td>{{ $pencapaian->program }}</td>
                <td>
                    <div class="indikator-kinerja">
                        @if (strlen($pencapaian->indikator_kinerja) > 50)
                            <span class="short-text">{{ substr($pencapaian->indikator_kinerja, 0, 50) }}</span>
                            <span class="dots">...</span>
                            <span class="long-text" style="display: none;">{{ substr($pencapaian->indikator_kinerja, 50) }}</span>
                            <button onclick="readMore(this)" class="btn btn-link p-0 m-0 align-baseline">read more</button>
                        @else
                            <span>{{ $pencapaian->indikator_kinerja }}</span>
                        @endif
                    </div>
                    
                </td>
                
                <td>
                    <select name="tipe">
                        <option value="(+)Semakin Baik-(UMUM)">(+)Semakin Baik-(UMUM)</option>
                        <option value="(-)Semakin Baik-(KHUSUS)">(+)Semakin Baik-(KHUSUS)</option>
                    </select>
                </td>
                <td>{{ $pencapaian->target }}%</td>
                <td><input type="type" name="realisasi_januari" class="w-50" value="{{$pencapaian->realisasi_januari}}">%</td>
                <td><input type="type" name="realisasi_februari" class="w-50" value="{{$pencapaian->realisasi_februari}}">%</td>
                <td><input type="type" name="realisasi_maret" class="w-50" value="{{$pencapaian->realisasi_maret}}">%</td>
                <td><input type="type" name="realisasi_april" class="w-50" value="{{$pencapaian->realisasi_april}}">%</td>
                <td><input type="type" name="realisasi_mei" class="w-50" value="{{$pencapaian->realisasi_mei}}">%</td>
                <td><input type="type" name="realisasi_juni" class="w-50" value="{{$pencapaian->realisasi_juni}}">%</td>
                <td><input type="type" name="realisasi_juli" class="w-50" value="{{$pencapaian->realisasi_juli}}">%</td>
                <td><input type="type" name="realisasi_agustus" class="w-50" value="{{$pencapaian->realisasi_agustus}}">%</td>
                <td><input type="type" name="realisasi_september" class="w-50" value="{{$pencapaian->realisasi_september}}">%</td>
                <td><input type="type" name="realisasi_oktober" class="w-50" value="{{$pencapaian->realisasi_oktober}}">%</td>
                <td><input type="type" name="realisasi_november" class="w-50" value="{{$pencapaian->realisasi_november}}">%</td>
                <td><input type="type" name="realisasi_desember" class="w-50" value="{{$pencapaian->realisasi_desember}}">%</td>
                <td><input type="type" name="realisasi_akhir" class="w-50" value="{{$pencapaian->realisasi_akhir}}">% 
                @if($pencapaian->realisasi_akhir != 0)
                    <div class="text-success">verified</div>
                @endif
            </td>
                <td>
                    <div class="definisi-operasional">
                        <input type="text" name="definisi_operasional" value="{{$pencapaian->definisi_operasional}}">
                        <label>Catatan :</label>
                        <label>{{$pencapaian->komentar}}</label>
                    </div>
                </td>
                <td>
                    @if(auth()->user()->role == 'admin')
                    <div class="con d-flex">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal{{$pencapaian->id}}">✔</button>
                    <a class="btn btn-warning mx-1" href="{{ route('pencapaian.edit', $pencapaian->id) }}">Update</a>
                    <a class="btn btn-danger" href="{{ route('pencapaian.delete', $pencapaian->id) }}">Delete</a>
                    </div>
                    @else
                    <button type="submit" class="btn btn-success">✔</button>
                    @endif
                    <div class="modal fade" id="modal{{$pencapaian->id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Komentar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea name="komentar" class="form-group" cols="30" rows="10">{{$pencapaian->komentar}}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>    
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
</body>
</html>