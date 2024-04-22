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
                </div>

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
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Upaya Kesehatan</th>
                                        <th rowspan="2">Kegiatan</th>
                                        <th rowspan="2">Satuan</th>
                                        <th colspan="4"class="text-center">Target Sasaran</th>
                                        <th rowspan="2">Pencapaian</th>
                                        <th rowspan="2">Cakupan</th>
                                        <th rowspan="2">Nilai</th>
                                        <th rowspan="2">Validasi</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sinikimas as $sinikimas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sinikimas->upaya_kesehatan }}</td>
                                        <td>{{ $sinikimas->kegiatan }}</td>
                                        <td>{{ $sinikimas->satuan }}</td>
                                        <td>{{ $sinikimas->target_1 }}</td>
                                        <td>{{ $sinikimas->target_2 }}</td>
                                        <td>{{ $sinikimas->target_persen }}</td>
                                        <td>{{ $sinikimas->target_des }}</td>
                                        <td>{{ $sinikimas->pencapaian }}</td>
                                        <td>{{ $sinikimas->cakupan }}</td>
                                        <td>{{ $sinikimas->nilai }}</td>
                                        <td>
                                            @if(auth()->user()->role == 'admin puskesmas')
                                            <div class="con d-flex">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal{{$sinikimas->id}}">✔</button>
                                            <a class="btn btn-warning mx-1" href="{{ route('sinikimas.edit', $sinikimas->id) }}">Update</a>
                                            <a class="btn btn-danger" href="{{ route('sinikimas.delete', $sinikimas->id) }}">Delete</a>
                                            </div>
                                            @else
                                            <button type="submit" class="btn btn-success">✔</button>
                                            @endif
                                            <div class="modal fade" id="modal{{$sinikimas->id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Komentar</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <textarea name="komentar" class="form-group" cols="30" rows="10">{{$sinikimas->komentar}}</textarea>
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
