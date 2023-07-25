@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <h2>Foto</h2>
    <a href="{{ route('foto.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Kavling</th>
                <th scope="col">Foto</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fotos as $foto)
            <tr>
                <td>{{ $foto->id }}</td>
                <td>{{ $foto->data->kavling }}</td>
                <td>
                    @if($foto->photo)
                    <img src="{{ asset('storage/' . $foto->photo) }}" class="card-img-top" alt="Foto">
                    @else
                    <p>Tidak ada foto</p>
                    @endif
                </td>
                <td>
                    <a href="{{ route('foto.show', $foto->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="{{ route('foto.edit', $foto->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="{{ route('foto.destroy', $foto->id) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $fotos->links() }}
    </div>
</div>
@endsection
