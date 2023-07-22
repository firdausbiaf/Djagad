@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <h2>Data User</h2><br>
    <a href="{{ route('data.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama User</th>
                <th scope="col">Telepon</th>
                <th scope="col">Alamat</th>
                <th scope="col">Kavling</th>
                <th scope="col">Tipe</th>
                <th scope="col">SPK</th>
                <th scope="col">Progres</th>
                <th scope="col">Cicilan</th>
                <th scope="col">Foto Progress</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->phone }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->kavling }}</td>
                <td>{{ $item->tipe }}</td>
                <td>{{ $item->spk }}</td>
                <td>{{ $item->progres }}</td>
                <td>{{ $item->cicilan }}</td>
                <td><img src="{{ asset('storage/' . $item->photo) }}" class="card-img-top" alt="{{ $item->photo }}"></td>
                <td>
                    <a href="{{ route('data.show', $item->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="{{ route('data.edit', $item->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="{{ route('data.destroy', $item->id) }}" method="post" class="d-inline">
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
        {{ $data->links() }}
    </div>
</div>
@endsection
