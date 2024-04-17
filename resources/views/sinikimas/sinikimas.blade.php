@extends('kerangka.master')
@section('content')

<!-- Basic Tables start -->
<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">INPUT</h4>
                </div>
                <div class="d-flex justify-content-start align-items-center p-2">
                @if(auth()->user()->role == 'admin puskesmas')
                    <a class="btn btn-primary me-2" href="{{ route('sinikimas.create') }}" style="width: 170px;">Tambah</a>
                @endif    
                <form action="{{route('sinikimas.subsinikimas')}}" method="GET" class="d-flex">
                    <select id="tahun" name="tahun" class="form-control  @error('tahun') is-invalid @enderror" style="width: 150px;">
                        <option value="" disabled selected>Tahun</option>
                        @foreach($tahun as $tah)    
                        <option value="{{$tah->tahun}}">{{$tah->tahun}}</option>
                        @endforeach
                        </select>
                        
                        @error('tahun')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                    <select id="jenis_cakupan" name="jenis_cakupan" class="form-control ms-2 @error('jenis_cakupan') is-invalid @enderror" style="width: 150px;">
                    <option value="" disabled selected>Jenis Cakupan</option>
                    @foreach($jenis_cakupan as $jcakupan)    
                    <option value="{{$jcakupan->jenis_cakupan}}">{{$jcakupan->jenis_cakupan}}</option>
                    @endforeach
                    </select>
                    
                    @error('jenis_cakupan')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <select id="jenis_indikator" name="jenis_indikator" class="form-control ms-2" style="width: 150px;">
                        <option value="" disabled selected>Indikator</option>
                        @foreach($jenis_indikator as $jindikator)
                        <option value="{{$jindikator->jenis_indikator}}">{{$jindikator->jenis_indikator}}</option>
                        @endforeach
                    </select>
                    
                    @error('jenis_indikator')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <select id="jenis_subindikator" name="jenis_subindikator" class="form-control ms-2" style="width: 150px;">
                        <option value="" disabled selected>Sub Indikator</option>
                        @foreach($jenis_subindikator as $jsubindikator)
                        <option value="{{$jsubindikator->jenis_subindikator}}">{{$jsubindikator->jenis_subindikator}}</option>
                        @endforeach
                    </select>
                    
                    @error('jenis_subindikator')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary ms-2" style="width: 120px;">OKE PILIH</button>
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
                                        <th>No</th>
                                        <th>Upaya Kesehatan</th>
                                        <th>Kegiatan</th>
                                        <th>Satuan</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Deskripsi</th>
                                        <th>Pencapaian</th>
                                        <th>Cakupan</th>
                                        <th>Nilai</th>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                </div>
                </div> <!-- Penutup div.card -->
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
@endsection
