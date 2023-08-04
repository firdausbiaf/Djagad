@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Foto</h2><br>
            <a href="{{ route('foto.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>
        </div>
    </div>

    <!-- Nav tabs for lokasi -->
    <ul class="nav nav-tabs" id="lokasiTab" role="tablist">
        @foreach ($lokasiList as $lokasi)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($loop->first) active @endif" id="{{ $lokasi }}-tab" data-lokasi="{{ $lokasi }}" data-toggle="tab" href="#lokasi-{{ $lokasi }}" role="tab" aria-controls="lokasi-{{ $lokasi }}" aria-selected="@if($loop->first) true @else false @endif">{{ $lokasi }}</a>
            </li>
        @endforeach
    </ul>

    <!-- Tab panes for lokasi -->
    <div class="tab-content" id="lokasiTabContent">
        @foreach ($lokasiList as $lokasi)
            <div class="tab-pane fade @if($loop->first) show active @endif" id="lokasi-{{ $lokasi }}" role="tabpanel" data-lokasi="{{ $lokasi }}">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Kavling</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tampilkan data foto sesuai dengan lokasi -->
                        @foreach ($fotosByLokasi[$lokasi] as $foto)
                            <tr class="table-row" data-lokasi="{{ $lokasi }}">
                                <td>{{ $foto->id }}</td>
                                <td>{{ $foto->data->lokasi }}</td>
                                <td>{{ $foto->data->kavling }}</td>
                                <td>
                                    @if ($foto->photo)
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
                        @if(count($fotosByLokasi[$lokasi]) === 0)
                            <tr>
                                <td colspan="5">Tidak ada data foto untuk lokasi {{ $lokasi }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Sembunyikan semua baris tabel dengan class .table-row kecuali yang pertama
    $('.tab-pane').not(':first').removeClass('show active').hide();

    // Saat halaman pertama kali dimuat, tampilkan data dari tab yang aktif saat itu
    const activeTab = $('#lokasiTab .nav-link.active');
    const lokasiId = activeTab.data('lokasi');
    $(`.tab-pane[data-lokasi="${lokasiId}"]`).addClass('show active').show();

    // Tangani peristiwa klik pada tab lokasi
    $('#lokasiTab .nav-link').on('click', function(e) {
        e.preventDefault();

        // Dapatkan lokasi yang dipilih dari data-lokasi atribut
        const lokasiId = $(this).data('lokasi');

        // Sembunyikan semua baris tabel dengan class .table-row
        $('.tab-pane').removeClass('show active').hide();

        // Tampilkan baris tabel yang sesuai dengan lokasiId yang dipilih pada tab yang aktif
        $(`.tab-pane[data-lokasi="${lokasiId}"]`).addClass('show active').show();
    });
});
</script>
@endsection
