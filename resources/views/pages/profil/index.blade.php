@extends('layouts.default')

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Profil</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <form action="{{ route('profil.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" value="{{ $profil[0]->nama_perusahaan }}">
                            <input type="hidden" name="profile_id" id="profile_id" class="form-control" value="{{ $profil[0]->id }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pemilik_1">Pemilik 1</label>
                            <input type="text" name="pemilik_1" id="pemilik_1" class="form-control" value="{{ $profil[0]->pemilik_1 }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pemilik_2">Pemilik 2</label>
                            <input type="text" name="pemilik_2" id="pemilik_2" class="form-control" value="{{ $profil[0]->pemilik_2 }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kontak_1">Kontak 1</label>
                            <input type="text" name="kontak_1" id="kontak_1" class="form-control" value="{{ $profil[0]->kontak_1 }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kontak_2">Kontak 2</label>
                            <input type="text" name="kontak_2" id="kontak_2" class="form-control" value="{{ $profil[0]->kontak_2 }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="deskripsi_1">Deskripsi 1</label>
                            <textarea rows="4" name="deskripsi_1" id="deskripsi_1" class="form-control">{{ $profil[0]->deskripsi_1 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="deskripsi_2">Deskripsi 2</label>
                            <textarea rows="4" name="deskripsi_2" id="deskripsi_2" class="form-control">{{ $profil[0]->deskripsi_2 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea rows="4" name="alamat" id="alamat" class="form-control">{{ $profil[0]->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            <button class="btn btn-success" id="simpan-profil">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection