@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Singhasari</h2><br>
            <a href="{{ route('singhasari.create') }}" class="btn btn-primary mb-3">Tambah Stok Singhasari</a>
        </div>
    </div>
    
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Kluster</th>
                <th scope="col">Kavling</th>
                <th scope="col">Sold</th>
                <th scope="col">Open</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1; 
            @endphp
            @foreach ($singhasaris as $singha)
            <tr>
                <td>{{ $count }}</td> <!-- Display the incrementing number -->
                @php
                    $count++; // Increment the counter
                @endphp
                <td>{{ $singha->kluster }}</td>
                <td>{{ $singha->kavling }}</td>
                {{-- <td>{{ $singha->stok }}</td> --}}
                <td>       
                    @if( $singha->sold  == 0)
                    <form action="/sold_out" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $singha->id }}">
                    <button type="submit" class="badge bg-warning border-0" ><span>&#10005;</span></button>
                    </form>

                    @else
                    <form action="/sold_in" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $singha->id }}">
                    <button type="submit" class="badge bg-success border-0" ><span>&#10003;</span></button>
                    </form>

                    @endif          
                </td>

                <td>       
                    @if( $singha->open == 0)
                    <form action="/open_out" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $singha->id }}">
                    <button type="submit" class="badge bg-warning border-0" ><span>&#10005;</span></button>
                    </form>

                    @else
                    <form action="/open_in" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $singha->id }}">
                    <button type="submit" class="badge bg-success border-0" ><span>&#10003;</span></button>
                    </form>

                    @endif          
                </td>
                <td>{{ $singha->keterangan }}</td>
                <td>
                    <a href="{{ route('singhasari.show', $singha->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="{{ route('singhasari.edit', $singha->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="{{ route('singhasari.destroy', $singha->id) }}" method="post" class="d-inline">
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
        {{ $singhasaris->links() }}
    </div>
</div>
@endsection
