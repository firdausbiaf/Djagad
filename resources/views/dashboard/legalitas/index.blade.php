@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Legalitas</h2><br>
            <a href="{{ route('legalitas.create') }}" class="btn btn-primary mb-3">Tambah Legalitas</a>
        </div>
    </div>
    
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nomor</th>
                <th scope="col">Kavling</th>
                <th scope="col">Uang Masuk</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Uang Keluar</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($legalitas as $legal)
            <tr>
                <td>{{ $legal->id }}</td>
                <td>{{ $legal->nomor }}</td>
                <td>{{ $legal->data->kavling }}</td>
                <td>       
                    @if( $legal->uang_masuk  == 0)
                    <form action="/uang_masuk_out" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $legal->id }}">
                    <button type="submit" class="badge bg-warning border-0" ><span>&#10005;</span></button>
                    </form>

                    @else
                    <form action="/uang_masuk_in" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $legal->id }}">
                    <button type="submit" class="badge bg-success border-0" ><span>&#10003;</span></button>
                    </form>

                    @endif          
                </td>
                <td>{{ $legal->tgl_masuk }}</td>
                <td>       
                    @if( $legal->uang_keluar == 0)
                    <form action="/uang_keluar_out" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $legal->id }}">
                    <button type="submit" class="badge bg-warning border-0" ><span>&#10005;</span></button>
                    </form>

                    @else
                    <form action="/uang_keluar_in" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $legal->id }}">
                    <button type="submit" class="badge bg-success border-0" ><span>&#10003;</span></button>
                    </form>

                    @endif          
                </td>
                <td>{{ $legal->tgl_keluar }}</td>
                
                <td>
                    <a href="{{ route('legalitas.show', $legal->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="{{ route('legalitas.edit', $legal->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="{{ route('legalitas.destroy', $legal->id) }}" method="post" class="d-inline">
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
        {{ $legalitas->links() }}
    </div>
</div>
@endsection
