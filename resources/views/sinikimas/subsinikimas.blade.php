
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
                <form action="{{route('sinikimas.subprogram')}}" method="GET" class="d-flex">
                    <select id="tahun" name="tahun" class="form-control @error('tahun') is-invalid @enderror" style="width: 150px;">
                        <option value="" disabled selected>Tahun</option>
                        @foreach($tahun as $tah)    
                        <option value="{{$tah->tahun}}">{{$tah->tahun}}</option>
                        @endforeach
                        </select>
                        
                        @error('tahun')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                    <select id="jenis_cakupan" name="jenis_cakupan" class="form-control @error('jenis_cakupan') is-invalid @enderror" style="width: 150px;">
                    <option value="" disabled selected>-- Jenis Cakupan --</option>
                    @foreach($jenis_cakupan as $jcakupan)    
                    <option value="{{$jcakupan->jenis_cakupan}}">{{$jcakupan->jenis_cakupan}}</option>
                    @endforeach
                    </select>
                    
                    @error('jenis_cakupan')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <select id="jenis_indikator" name="jenis_indikator" class="form-control ms-2" style="width: 150px;">
                        <option value="" disabled selected>-- Jenis Indikator --</option>
                        @foreach($jenis_indikator as $jindikator)
                        <option value="{{$jindikator->jenis_indikator}}">{{$jindikator->jenis_indikator}}</option>
                        @endforeach
                    </select>
                    
                    @error('jenis_indikator')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <select id="jenis_subindikator" name="jenis_subindikator" class="form-control ms-2" style="width: 150px;">
                        <option value="" disabled selected>-- Jenis Indikator --</option>
                        @foreach($jenis_subindikator as $jsubindikator)
                        <option value="{{$jsubindikator->jenis_subindikator}}">{{$jsubindikator->jenis_subindikator}}</option>
                        @endforeach
                    </select>
                    
                    @error('jenis_subindikator')
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