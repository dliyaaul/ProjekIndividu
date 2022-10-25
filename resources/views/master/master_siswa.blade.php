@extends('layout.admin')
@section('content-title', 'Master Siswa')
@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('master_siswa.create') }}" class="btn btn-success">Tambah Data</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NISN</th>
                            <th scope="col">ALAMAT</A></th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $i => $item)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $item -> nama }}</td>
                            <td>{{ $item -> nisn }}</td>
                            <td>{{ $item -> alamat }}</td>
                            <td>
                                <a href="{{ route('master_siswa.show', $item -> id) }}" class="btn btn-sm btn-info btn-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('master_siswa.edit', $item -> id) }}" class="btn btn-sm btn-warning btn-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('master_siswa.hapus', $item -> id) }}" class="btn btn-sm btn-danger btn-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection