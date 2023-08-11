@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Promo</h2><br>
            <a href="{{ route('promo.create') }}" class="btn btn-primary mb-3">Tambah Promo</a>
        </div>
    </div>
    
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Gambar</th>
                <th scope="col">Action</th>
        </thead>
        <tbody>
            @php
              $count = 1; 
            @endphp
            @foreach ($promo as $item)
            <tr>
                <td>{{ $count }}</td> <!-- Display the incrementing number -->
                @php
                    $count++; // Increment the counter
                @endphp
                <td>{{ $item->promo_id }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->gambar }}</td>
                <td>
                    <a href="{{ route('promo.show', $item->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="{{ route('promo.edit', $item->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="{{ route('promo.destroy', $item->id) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-center">
    {{ $promo->links() }}
  </div>
</div>
@endsection