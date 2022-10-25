@extends('layout.admin')
@section('title', 'Tambah Siswa')
@section('content-title', 'Tambah Siswa')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" enctype="multipart/form-data" action="{{ route('master_siswa.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">NAMA</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                    </div>
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn">
                    </div>
                    <div class="form-group">
                        <label for="alamat">ALAMAT</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="jk">JENIS KELAMIN</label>
                        <select class="form-select form-control" name="jk" id="jk">
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto">FOTO</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                        <label for="about">ABOUT</label>
                        <textarea name="about" id="about" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <!-- <a class="btn btn-success" type="submit">Simpan</a> -->
                        <input type="submit" class="btn btn-success" value="Simpan">
                        <a href="{{ route('master_siswa.index')}}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection