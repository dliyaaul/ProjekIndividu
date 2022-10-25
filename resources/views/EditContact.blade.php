@extends('layout.admin')
@section('title', 'Edit Kontak')
@section('content-title', 'Edit Kontak')
@section('content')
{{-- {{ dd($kontak->id) }} --}}
<h1>Halaman Edit Contact</h1>
<p>ID Jenis Kontak : {{ $kontak->jenis_kontak_id }}</p>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $item)
                        <li>{{$item}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="post" enctype="multipart/form-data" action="{{ route('master_contact.update', $contact->id )}}">
                    @csrf
                    @method('put')
                    <div class=" form-group">
                        <label for="jenis_kontak">Jenis Contact</label>
                        <div class="input-group mb-3">
                            <select name="jenis_kontak" id="jenis_kontak" class="custom-select">
                                {{-- <option selected>{{ $kontak->jenis_kontak_id }}</option> --}}
                                @foreach ($j_kontak as $j_contact)
                                <option value="{{ $j_kontak->id }}">{{ $j_kontak->jenis_kontak}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Deskripsi Contact</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="{{ $kontak->deskripsi }}">
                    </div>
                    <div class="form-group">
                        <a href="{{ route('master_project.index') }}" class="btn btn-danger">Batal</a>
                        <button class="btn btn-success" type="submit" value="Update">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection