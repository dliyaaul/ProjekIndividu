@extends('layout.admin')
@section('title', 'Tambah Kontak')
@section('content-title', 'Tambah Kontak')
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
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ url('tambahjenis/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden">
            <div class="form-group">
            </div>
            <div class="form-group">
                <label for="nama">Tambah Jenis Kontak</label>
                <textarea name="jenis_kontak" id="Tambah Jenis Kontak" class="form-control"></textarea>
            </div>
            <br>
            <div class="form-group">
                <a href="{{ route('master_contact.index') }}" class="btn btn-danger">Batal</a>
                <input type="submit" class="btn btn-success" value="Simpan">
            </div>
        </form>
    </div>
</div>
@endsection