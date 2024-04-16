@extends('kerangka.master')
@section('content')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Create </h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" method="POST" action="{{ route('sinikimas.store') }}">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>No</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="no" name="no"
                                    class="form-control @error('no') is invalid @enderror"
                                    value="{{ old('no') }}" placeholder="no">
                                @error('no')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Upaya Kesehatan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="upaya_kesehatan" name="upaya_kesehatan"
                                    class="form-control @error('upaya_kesehatan') is invalid @enderror" value="{{ old('upaya_kesehatan') }}"
                                    placeholder="Upaya Kesehatann">
                                @error('upaya_kesehatan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Kegiatan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="kegiatan" name="kegiatan"
                                    class="form-control @error('kegiatan') is invalid @enderror"
                                    value="{{ old('kegiatan') }}" placeholder="Kegiatan">
                                @error('kegiatan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>