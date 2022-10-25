@extends('layout.admin')
@section('title', 'Tambah Kontak')
@section('content-title', 'Tambah Kontak - '.$siswa->nama)
@section('content')
@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $item)
        <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="post" enctype="multipart/form-data" action="{{ route('master_contact.store') }}">
    @csrf
    <div class="form-group">
        <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
        <label for="nama">Nama Contact</label>
        <input type="text" class="form-control" id="jenis_kontak" name="jenis_kontak">
    </div>
    <div class="form-group">
        <label for="nama">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <a href="{{ route('master_contact.index') }}" class="btn btn-danger">Batal</a>
        <input type="submit" class="btn btn-success" value="Simpan">
    </div>
</form>
@endsection