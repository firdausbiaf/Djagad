@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Foto</h2><br>
            <a href="{{ route('foto.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>
        </div>
        <div class="col-md-6 text-right">
            <!-- Filter Lokasi Select Option -->
            <form action="{{ route('foto.index') }}" method="GET" class="form-inline">
                <div class="form-group mb-2">
                    <label for="lokasi" class="mr-2">Filter Lokasi:</label>
                    <select name="lokasi" id="lokasi" class="form-control">
                        <option value="">Semua Lokasi</option>
                        @foreach ($lokasiOptions as $lokasi)
                        <option value="{{ $lokasi }}" @if($lokasi == $selectedLokasi) selected @endif>{{ $lokasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2 ml-2">
                    <label for="kavling" class="mr-2">Filter Kavling:</label>
                    <select name="kavling" id="kavling" class="form-control">
                        <option value="">Semua Kavling</option>
                        @foreach ($kavlingOptions as $kavling)
                        <option value="{{ $kavling }}" @if($kavling == $selectedKavling) selected @endif>{{ $kavling }}</option>
                        @endforeach
                    </select>
                </div>
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
        <tbody>
            @foreach ($fotos as $foto)
            <tr>
                <td>{{ $foto->id }}</td>
                <td>{{ $foto->data->lokasi }}</td>
                <td>{{ $foto->data->kavling}}</td>
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

@push('scripts')
<script>
    // Fungsi untuk mengambil kavling berdasarkan lokasi menggunakan AJAX
    function getKavlingsByLocation() {
        const lokasiSelect = document.getElementById('lokasi');
        const kavlingSelect = document.getElementById('kavling');

        if (!lokasiSelect.value) {
            kavlingSelect.innerHTML = '<option value="">Semua Kavling</option>';
            return;
        }

        fetch(`/get-kavlings?lokasi=${lokasiSelect.value}`)
            .then((response) => response.json())
            .then((data) => {
                kavlingSelect.innerHTML = '<option value="">Semua Kavling</option>';
                Object.entries(data).forEach(([kavling]) => {
                    kavlingSelect.innerHTML += `<option value="${kavling}">${kavling}</option>`;
                });
            })
            .catch((error) => {
                console.error('Error fetching kavlings:', error);
            });
    }

    // Panggil fungsi getKavlingsByLocation saat lokasi berubah
    const lokasiSelect = document.getElementById('lokasi');
    lokasiSelect.addEventListener('change', getKavlingsByLocation);
</script>
@endpush
