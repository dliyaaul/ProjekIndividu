@extends('layout.admin')
@section('title', 'Edit Project')
@section('content-title', 'Edit Project - '.$project->nama)
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

<form method="post" enctype="multipart/form-data" action="{{ route('master_project.update', $project->id )}}">
    @csrf
    @method('put')
    <div class=" form-group">
        <label for="nama">Nama Project</label>
        <input type="text" class="form-control" id="nama_project" name="nama_project" value="{{ $project->nama_project }}">
    </div>
    <div class="form-group">
        <label for="nama">Deskripsi Project</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $project->deskripsi }}</textarea>
    </div>
    <div class="form-group">
        <label for="nama">Tanggal Project</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $project->tanggal }}">
    </div>
    <div class="form-group">
        <a href="{{ route('master_project.index') }}" class="btn btn-danger">Batal</a>
        <button class="btn btn-success" type="submit" value="Update">Simpan</button>
    </div>
</form>

@endsection