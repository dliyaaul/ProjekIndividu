@if ($kontak->isEmpty())
<h6>Siswa belum memiliki Contact</h6>
@else
@foreach($kontak as $item)
<div class="card mb-3">
    <div class="card-header">
        {{-- <strong>{{$item->nama_project}}</strong> --}}
    </div>
    <div class="card-body">
        <strong>Jenis Contact :</strong>
        <p>{{$item->jenis_kontak</p>
        <strong>Deskripsi Contact :</strong>
        <p>{{$item->pivot->deskripsi}}</p>
    </div>
    <div class="card-footer">
        @if (auth()->user()->role==0)
        <a href="{{ route('master_contact.edit', $item -> id) }}" class="btn btn-sm btn-warning btn-circle">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('master_contact.hapus', $item -> id) }}" class="btn btn-sm btn-danger btn-circle">
            <i class="fas fa-trash"></i>
        </a>
        @endif
    </div>
</div>
@endforeach
{{-- <div class="card-footer d-flex justify-content-end">
    {{ $kontak->links() }}
</div> --}}
@endif