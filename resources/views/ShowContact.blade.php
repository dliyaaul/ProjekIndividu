@if ($kontak->isEmpty())
<h6>Siswa belum memiliki kontak</h6>
@else
@foreach($kontak as $item)
<div class="card">
    <div class="card-header">
        <strong>{{$item->jenis_kontak}}</strong>
    </div>
    <div class="card-body">
        <strong>Jenis Contact :</strong>
        <p>{{$item->jenis_kontak}}</p>
        <strong>Deskripsi Contact :</strong>
        <p>{{$item->pivot->deskripsi}}</p>
    </div>
    <div class="card-footer">
        <!-- <button type="submit" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-trash"></i></button>
        <a href="{{ route('master_contact.edit', $item->pivot->id)}}" class="btn btn-sm btn-warning btn-circle">
            <i class="fas fa-edit"></i>
        </a> -->
        <form action="/master_contact/{{$item->pivot->id}}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-trash"></i></button>
            <a href="{{ route('master_contact.edit', $item->pivot->id) }}" class="btn btn-sm btn-warning btn-circle">
                <i class="fas fa-edit"></i>
            </a>
        </form>
    </div>
</div>
<br>
@endforeach
@endif