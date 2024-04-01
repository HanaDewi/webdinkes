@extends('kerangka.master')

@section('content')

<!-- Basic Tables start -->
<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">INPUT REALISASI PROGRAM</h4>
                </div>
                <div class="d-flex justify-content-start align-items-center p-2">
                @if(auth()->user()->role == 'admin')
                    <a class="btn btn-primary me-2" href="{{ route('pencapaian.create') }}" style="width: 170px;">Tambah Pencapaian</a>
                @endif    
                <form action="{{route('pencapaian.subprogram')}}" method="GET" class="d-flex">
                    <select id="tahun" name="tahun" class="form-control @error('tahun') is-invalid @enderror" style="width: 150px;">
                    <option value="" disabled selected>-- Tahun --</option>
                    @foreach($tahun as $tah)    
                    <option value="{{$tah->tahun}}">{{$tah->tahun}}</option>
                    @endforeach
                    </select>
                    
                    @error('tahun')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <select id="program" name="program" class="form-control ms-2" style="width: 150px;">
                        <option value="" disabled selected>-- Program --</option>
                        @foreach($program as $prog)
                        <option value="{{$prog->program}}">{{$prog->program}}</option>
                        @endforeach
                    </select>
                    
                    @error('program')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <select id="apbd" name="apbd" class="form-control ms-2" style="width: 200px;">
                        <option value="" disabled selected>-- Tahapan APBD --</option>
                        <option value="Murni">Murni</option>
                        <option value="Pergeseran">Pergeseran</option>
                    </select>
                    @error('apbd')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary ms-2" style="width: 120px;">OKE PILIH</button>
                </div>
                </form>
                

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
                                    @csrf
                                    @else
                                    <form action="{{route('pencapaian.submit.admin',$pencapaian->id)}}" method="POST">
                                    @csrf
                                    @endif
                                    
                                    <tr>
                                        
                                        <td>{{ $pencapaian->kode }}</td>
                                        <td>{{ $pencapaian->program }}</td>
                                        <td>
                                            <div class="indikator-kinerja">
                                                @if (strlen($pencapaian->indikator_kinerja) > 50)
                                                    {{ substr($pencapaian->indikator_kinerja, 0, 50) }}<span class="dots">...</span><span class="more" style="display: none;">{{ substr($pencapaian->definisi_operasional, 100) }}</span>
                                                    <button onclick="readMore(this)" class="btn btn-link p-0 m-0 align-baseline">read more</button>
                                                @else
                                                    {{ $pencapaian->indikator_kinerja }}
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
                                        
                                        @if(auth()->user()->role == 'user')
                                        <td><input type="type" name="realisasi_akhir" class="w-50" value="{{$pencapaian->realisasi_akhir}}">% 
                                        @else
                                        <td><input type="type" name="realisasi_akhir" class="w-50" value="{{$pencapaian->realisasi_akhir_2}}">% 
                                        @endif
                                        @if($pencapaian->realisasi_akhir != 0)
                                            <button type="button" class="btn btn-success">✔</button>
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
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal{{$pencapaian->id}}">✔</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Tables end -->
@endsection
