@extends('layout.admin')
@section('title', 'Edit Siswa')
@section('content-title', 'Edit Siswa')
@section('content')
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
                <form method="post" enctype="multipart/form-data" action="{{ route('master_siswa.update', $siswa->id )}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama">NAMA</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $siswa->nisn }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">ALAMAT</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $siswa->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="jk">JENIS KELAMIN</label>
                        <select class="form-select form-control" name="jk" id="jk">
                            <option value="laki-laki" @if($siswa->jk == 'laki-laki') selected @endif>Laki-laki</option>
                            <option value="perempuan" @if($siswa->jk == 'perempuan') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto">FOTO</label>
                        <img src="{{ asset ('/template/img/'.$siswa->foto) }}" width="150">
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                        <label for="about">ABOUT</label>
                        <textarea name="about" id="about" class="form-control" cols="30" rows="10">{{ $siswa->about }}</textarea>
                    </div>
                    <div class=" form-group">
                        <input type="submit" value="simpan" class="btn btn-success">
                        <a href="{{ route('master_siswa.index')}}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection