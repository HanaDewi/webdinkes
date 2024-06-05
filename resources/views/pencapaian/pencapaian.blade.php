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
                    <form action="{{ route('pencapaian.subprogram') }}" method="GET" class="d-flex">
                        <select id="tahun" name="tahun" class="form-control @error('tahun') is-invalid @enderror" style="width: 150px;">
                            <option value="" disabled {{ request('tahun') ? '' : 'selected' }}>-- Tahun --</option>
                            @foreach($tahun as $tah)    
                                <option value="{{ $tah->tahun }}" {{ request('tahun') == $tah->tahun ? 'selected' : '' }}>{{ $tah->tahun }}</option>
                            @endforeach
                        </select>
                        @error('tahun')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select id="keg" name="keg" class="form-control ms-2" style="width: 150px;">
                            <option value="" disabled {{ request('keg') ? '' : 'selected' }}>-- Capaian --</option>
                            @foreach($keg as $kegi)
                                <option value="{{ $kegi->keg }}" {{ request('keg') == $kegi->keg ? 'selected' : '' }}>{{ $kegi->keg }}</option>
                            @endforeach
                        </select>
                        @error('keg')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select id="apbd" name="apbd" class="form-control ms-2" style="width: 200px;">
                            <option value="" disabled {{ request('apbd') ? '' : 'selected' }}>-- Tahapan APBD --</option>
                            <option value="Murni" {{ request('apbd') == 'Murni' ? 'selected' : '' }}>Murni</option>
                            <option value="Pergeseran" {{ request('apbd') == 'Pergeseran' ? 'selected' : '' }}>Pergeseran</option>
                        </select>
                        @error('apbd')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select id="bulan" name="bulan" class="form-control ms-2" style="width: 200px;">
                            <option value="all" {{ request('bulan') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="januari" {{ request('bulan') == 'januari' ? 'selected' : '' }}>Januari</option>
                            <option value="februari" {{ request('bulan') == 'februari' ? 'selected' : '' }}>Februari</option>
                            <option value="maret" {{ request('bulan') == 'maret' ? 'selected' : '' }}>Maret</option>
                            <option value="april" {{ request('bulan') == 'april' ? 'selected' : '' }}>April</option>
                            <option value="mei" {{ request('bulan') == 'mei' ? 'selected' : '' }}>Mei</option>
                            <option value="juni" {{ request('bulan') == 'juni' ? 'selected' : '' }}>Juni</option>
                            <option value="juli" {{ request('bulan') == 'juli' ? 'selected' : '' }}>Juli</option>
                            <option value="agustus" {{ request('bulan') == 'agustus' ? 'selected' : '' }}>Agustus</option>
                            <option value="september" {{ request('bulan') == 'september' ? 'selected' : '' }}>September</option>
                            <option value="oktober" {{ request('bulan') == 'oktober' ? 'selected' : '' }}>Oktober</option>
                            <option value="november" {{ request('bulan') == 'november' ? 'selected' : '' }}>November</option>
                            <option value="desember" {{ request('bulan') == 'desember' ? 'selected' : '' }}>Desember</option>
                        </select>
                        
                        @error('bulan')
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Program</th>
                                        <th>Indikator Kinerja</th>
                                        <th>Tipe</th>
                                        <th>Target</th>
                                        @if(request('bulan') == 'all' || request('bulan') == 'januari')
                                            <th>Realisasi Januari</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'februari')
                                            <th>Realisasi Februari</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'maret')
                                            <th>Realisasi Maret</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'april')
                                            <th>Realisasi April</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'mei')
                                            <th>Realisasi Mei</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'juni')
                                            <th>Realisasi Juni</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'juli')
                                            <th>Realisasi Juli</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'agustus')
                                            <th>Realisasi Agustus</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'september')
                                            <th>Realisasi September</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'oktober')
                                            <th>Realisasi Oktober</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'november')
                                            <th>Realisasi November</th>
                                        @endif
                                        @if(request('bulan') == 'all' || request('bulan') == 'desember')
                                            <th>Realisasi Desember</th>
                                        @endif

                                        <!-- Add other month headers similarly -->
                                        <th>Realisasi Akhir</th>
                                        <th>Catatan</th>
                                        <th>Submit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pencapaians as $pencapaian)
                                    <form action="{{ route('pencapaian.submit.user', $pencapaian->id) }}" method="POST">
                                        @csrf
                                        <tr>
                                            <td>{{ $pencapaian->kode }}</td>
                                            <td>{{ $pencapaian->program }}</td>
                                            <td>{{ $pencapaian->indikator_kinerja }}</td>
                                            <td>
                                                <select name="tipe">
                                                    <option value="(+)Semakin Baik-(UMUM)" {{ $pencapaian->tipe == '(+)Semakin Baik-(UMUM)' ? 'selected' : '' }}>(+)Semakin Baik-(UMUM)</option>
                                                    <option value="(-)Semakin Baik-(KHUSUS)" {{ $pencapaian->tipe == '(-)Semakin Baik-(KHUSUS)' ? 'selected' : '' }}> (-)Semakin Baik-(KHUSUS)</option>
                                                </select>
                                            </td>
                                            <td>{{ $pencapaian->target }}%</td>
                                            @if(request('bulan') == 'all' || request('bulan') == 'januari')
                                                <td>
                                                    @if($pencapaian->realisasi_januari)
                                                        {{ $pencapaian->realisasi_januari }}%
                                                        <input type="hidden" name="realisasi_januari" value="{{ $pencapaian->realisasi_januari }}">
                                                    @else
                                                        <input type="text" name="realisasi_januari" class="w-50" value="" placeholder="">
                                                    @endif
                                                </td>
                                            @endif
                                            @if(request('bulan') == 'all' || request('bulan') == 'februari')
                                                <td>
                                                    @if($pencapaian->realisasi_februari)
                                                        {{ $pencapaian->realisasi_februari }}%
                                                        <input type="hidden" name="realisasi_februari" value="{{ $pencapaian->realisasi_februari }}">
                                                    @else
                                                        <input type="text" name="realisasi_februari" class="w-50" value="" placeholder="">
                                                    @endif
                                                </td>
                                            @endif
                                            @if(request('bulan') == 'all' || request('bulan') == 'maret')
                                                <td>
                                                    @if($pencapaian->realisasi_maret)
                                                        {{ $pencapaian->realisasi_maret }}%
                                                        <input type="hidden" name="realisasi_maret" value="{{ $pencapaian->realisasi_maret }}">
                                                    @else
                                                        <input type="text" name="realisasi_maret" class="w-50" value="" placeholder="">
                                                    @endif
                                                </td>
                                            @endif

                                            @if(request('bulan') == 'all' || request('bulan') == 'april')
                                                <td>
                                                    @if($pencapaian->realisasi_april)
                                                        {{ $pencapaian->realisasi_april }}%
                                                        <input type="hidden" name="realisasi_april" value="{{ $pencapaian->realisasi_april }}">
                                                    @else
                                                        <input type="text" name="realisasi_april" class="w-50" value="" placeholder="">
                                                    @endif
                                                </td>
                                            @endif

                                            @if(request('bulan') == 'all' || request('bulan') == 'mei')
                                            <td>
                                                @if($pencapaian->realisasi_mei)
                                                    {{ $pencapaian->realisasi_mei }}%
                                                    <input type="hidden" name="realisasi_mei" value="{{ $pencapaian->realisasi_mei }}">
                                                @else
                                                    <input type="text" name="realisasi_mei" class="w-50" value="" placeholder="">
                                                @endif
                                            </td>
                                        @endif
                                        
                                        @if(request('bulan') == 'all' || request('bulan') == 'juni')
                                            <td>
                                                @if($pencapaian->realisasi_juni)
                                                    {{ $pencapaian->realisasi_juni }}%
                                                    <input type="hidden" name="realisasi_juni" value="{{ $pencapaian->realisasi_juni }}">
                                                @else
                                                    <input type="text" name="realisasi_juni" class="w-50" value="" placeholder="">
                                                @endif
                                            </td>
                                        @endif
                                        
                                        @if(request('bulan') == 'all' || request('bulan') == 'juli')
                                        <td>
                                                @if($pencapaian->realisasi_juli)
                                                    {{ $pencapaian->realisasi_juli }}%
                                                    <input type="hidden" name="realisasi_juli" value="{{ $pencapaian->realisasi_juli }}">
                                                @else
                                                    <input type="text" name="realisasi_juli" class="w-50" value="" placeholder="">
                                                @endif
                                            </td>
                                        @endif

                                        @if(request('bulan') == 'all' || request('bulan') == 'agustus')
                                            <td>
                                                @if($pencapaian->realisasi_agustus)
                                                    {{ $pencapaian->realisasi_agustus }}%
                                                    <input type="hidden" name="realisasi_agustus" value="{{ $pencapaian->realisasi_agustus }}">
                                                @else
                                                    <input type="text" name="realisasi_agustus" class="w-50" value="" placeholder="">
                                                @endif
                                            </td>
                                        @endif

                                        @if(request('bulan') == 'all' || request('bulan') == 'september')
                                        <td>
                                            @if($pencapaian->realisasi_september)
                                                {{ $pencapaian->realisasi_september }}%
                                                <input type="hidden" name="realisasi_september" value="{{ $pencapaian->realisasi_september }}">
                                            @else
                                                <input type="text" name="realisasi_september" class="w-50" value="" placeholder="">
                                            @endif
                                        </td>
                                    @endif
                                    
                                    @if(request('bulan') == 'all' || request('bulan') == 'oktober')
                                        <td>
                                            @if($pencapaian->realisasi_oktober)
                                                {{ $pencapaian->realisasi_oktober }}%
                                                <input type="hidden" name="realisasi_oktober" value="{{ $pencapaian->realisasi_oktober }}">
                                            @else
                                                <input type="text" name="realisasi_oktober" class="w-50" value="" placeholder="">
                                            @endif
                                        </td>
                                    @endif
                                    
                                    @if(request('bulan') == 'all' || request('bulan') == 'november')
                                        <td>
                                            @if($pencapaian->realisasi_november)
                                                {{ $pencapaian->realisasi_november }}%
                                                <input type="hidden" name="realisasi_november" value="{{ $pencapaian->realisasi_november }}">
                                            @else
                                                <input type="text" name="realisasi_november" class="w-50" value="" placeholder="">
                                            @endif
                                        </td>
                                    @endif
                                    
                                    @if(request('bulan') == 'all' || request('bulan') == 'desember')
                                        <td>
                                            @if($pencapaian->realisasi_desember)
                                                {{ $pencapaian->realisasi_desember }}%
                                                <input type="hidden" name="realisasi_desember" value="{{ $pencapaian->realisasi_desember }}">
                                            @else
                                                <input type="text" name="realisasi_desember" class="w-50" value="" placeholder="">
                                            @endif
                                        </td>
                                    @endif 
                                    @if(auth()->user()->role == 'admin')
                                    <td><input type="type" name="realisasi_akhir" class="w-50" value="{{$pencapaian->realisasi_akhir}}"readonly>%
                                    @else
                                    <td><input type="type" name="realisasi_akhir" class="w-50" value="{{$pencapaian->realisasi_akhir_2}}"readonly>%
                                    @endif
                                    @if($pencapaian->realisasi_akhir != 0)
                                        <div class="text-success"></div>
                                    @endif
                                </td>
                                <td>
                                    <div class="komentar">
                                        <label></label>
                                        <label>{{ $pencapaian->komentar }}</label>
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
<!-- Basic Tables end -->
@endsection
