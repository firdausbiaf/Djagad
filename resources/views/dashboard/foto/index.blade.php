@extends('layout.dashboard.main')

@section('content')
<script>
    const kavlingDataURL = '/api/getKavlingsByLocation';
</script>

<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Foto</h2><br>
            <a href="{{ route('foto.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($fotosByLokasi as $lokasi => $data)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($loop->first) active @endif" id="{{ $lokasi }}-tab" data-toggle="tab" href="#lokasi-{{ $lokasi }}" role="tab" aria-controls="lokasi-{{ $lokasi }}" aria-selected="true">{{ $lokasi }}</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content" id="myTabContent">
        @foreach ($fotosByLokasi as $lokasi => $data)
            <div class="tab-pane fade @if($loop->first) show active @endif" id="lokasi-{{ $lokasi }}" role="tabpanel" aria-labelledby="{{ $lokasi }}-tab">
                <div class="row mb-3">
                    <div class="col-md-6 text-right">
                        <!-- Filter Kavling Select Option -->
                        <form action="{{ route('foto.filter') }}" method="GET" class="form-inline">
                            <div class="form-group mb-2">
                                <label for="kavling-{{ $lokasi }}" class="mr-2">Filter Kavling:</label>
                                <select name="kavling" id="kavling-{{ $lokasi }}" class="form-control">
                                    <option value="">Semua Kavling</option>
                                    @foreach ($data['kavlingOptions'] as $kavling)
                                        <option value="{{ $kavling }}">{{ $kavling }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="lokasi" value="{{ $lokasi }}">
                            <button type="submit" class="btn btn-primary mb-2 ml-2">Filter</button><br>
                        </form>
                    </div>
                </div>

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
                    <tbody id="table-data-{{ $lokasi }}">
                        @foreach ($data['fotos'] as $foto)
                            <tr>
                                <td>{{ $foto->id }}</td>
                                <td>{{ $lokasi }}</td>
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
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk menampilkan foto berdasarkan kavling yang dipilih
        function showFotoByKavling(kavlingId, lokasi) {
            // Dapatkan konten HTML dari tabel berdasarkan lokasi
            const tableData = $('#table-data-' + lokasi);

            // Sembunyikan semua baris di tabel
            tableData.find('tr').hide();

            // Tampilkan foto yang sesuai dengan kavlingId yang dipilih
            tableData.find('tr[data-kavling="' + kavlingId + '"]').show();
        }

        // Fungsi untuk mengambil data kavling berdasarkan lokasi
        function getKavlingsByLocation(locationId) {
            // Dapatkan data kavling berdasarkan lokasi dari server
            $.ajax({
                url: kavlingDataURL + '?lokasi=' + locationId,
                method: 'GET',
                success: function(response) {
                    // Kosongkan pilihan kavling yang ada saat ini
                    $('#kavling-' + locationId).empty();

                    // Tambahkan pilihan kavling yang sesuai
                    response.forEach(function(kavling) {
                        $('#kavling-' + locationId).append(
                            $('<option></option>').val(kavling).html(kavling)
                        );
                    });

                    // Setelah data kavling diperbarui, panggil fungsi untuk menampilkan foto berdasarkan kavling yang dipilih
                    const kavlingId = $('#kavling-' + locationId).val();
                    showFotoByKavling(kavlingId, locationId);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        // Saat halaman dimuat, tampilkan foto dan data kavling berdasarkan tab pertama yang aktif
        const firstLokasiTab = $('#myTab .nav-link.active');
        const firstLokasiId = firstLokasiTab.attr('id').replace('-tab', '');
        const firstKavlingId = $('#kavling-' + firstLokasiId + ' option:selected').val();
        showFotoByKavling(firstKavlingId, firstLokasiId);
        getKavlingsByLocation(firstLokasiId);

        // Tangani peristiwa klik pada tab lokasi
        $('#myTab .nav-link').on('click', function(e) {
            e.preventDefault();

            // Hapus kelas 'active' dari semua tab lokasi
            $('#myTab .nav-link').removeClass('active');

            // Tambahkan kelas 'active' pada tab lokasi yang diklik
            $(this).addClass('active');

            // Ambil lokasiId dari atribut id
            const lokasiId = $(this).attr('id').replace('-tab', '');

            // Ambil kavlingId yang saat ini terpilih pada dropdown
            const kavlingId = $('#kavling-' + lokasiId + ' option:selected').val();

            // Tampilkan foto dan data kavling berdasarkan tab dan dropdown yang dipilih
            showFotoByKavling(kavlingId, lokasiId);
            getKavlingsByLocation(lokasiId);
        });

        // Tangani peristiwa klik pada dropdown kavling
        $('select[id^="kavling-"]').on('change', function() {
            // Ambil kavlingId yang dipilih pada dropdown
            const kavlingId = $(this).val();

            // Ambil lokasiId dari atribut id dropdown
            const lokasiId = $(this).attr('id').replace('-kavling', '');

            // Tampilkan foto berdasarkan kavling yang dipilih
            showFotoByKavling(kavlingId, lokasiId);
        });
    });
</script>
@include('layout.bar.scripts')
@endpush
