@extends('layout.admin')
@section('title', 'Edit Kontak')
@section('content-title', 'Edit Kontak')
@section('content')
@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('master_contact.update', $kontak->id )}}">
            @csrf
            @method('PUT')
            <input type="hidden" name="siswa_id" value="{{ $kontak->siswa_id }}">
            <div class="form-group">
                <label for="nama">Jenis</label>
                <select name="jenis_kontak_id" id="jenis_kontak_id" class="form-control">
                    <option value="">Pilih Kontak</option>
                    @foreach ($jenis as $item)
                    <option value="{{ $item->id }}">{{ $item->jenis_kontak}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Deskripsi Contact</label>
                <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="{{ $kontak->deskripsi }}">
            </div>
            <div class="form-group">
                <a href="{{ route('master_contact.index') }}" class="btn btn-danger">Batal</a>
                <button class="btn btn-success" type="submit" value="Update">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection