@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Edit Foto</h2>
    <form action="{{ route('foto.update', $foto->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" required>
                <option value="">Pilih Lokasi</option>
                @foreach ($lokasiOptions as $lokasi)
                    <option value="{{ $lokasi }}" {{ old('lokasi', $foto->data->lokasi) == $lokasi ? 'selected' : '' }}>
                        {{ $lokasi }}
                    </option>
                @endforeach
            </select>
            @error('lokasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kavling" class="form-label">Kavling</label>
            <select class="form-select @error('kavling') is-invalid @enderror" name="kavling" id="kavling" required>
                <option value="">Pilih Kavling</option>
                @foreach ($kavlingOptions as $kavling)
                    <option value="{{ $kavling }}" {{ old('kavling', $foto->data->kavling) == $kavling ? 'selected' : '' }}>
                        {{ $kavling }}
                    </option>
                @endforeach
            </select>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label @error('photo') is-invalid @enderror">Foto</label>
            <div>
                <input class="form-control" type="file" id="photo" name="photo" onchange="previewImage()">
            </div>
            @error('photo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <!-- Tambahkan elemen img-preview di sini -->
            <img class="img-preview mt-2" style="max-width: 200px; max-height: 200px;" src="{{ asset('storage/' . $foto->photo) }}" alt="Preview">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    const kavlingOptions = {!! json_encode($kavlingOptions) !!};

    document.getElementById('lokasi').addEventListener('change', function() {
        const selectedLokasi = this.value;
        const kavlingSelect = document.getElementById('kavling');

        // Kosongkan pilihan kavling terlebih dahulu
        kavlingSelect.innerHTML = '<option value="">Pilih Kavling</option>';

        // Tambahkan pilihan kavling sesuai dengan lokasi yang dipilih
        if (selectedLokasi in kavlingOptions) {
            kavlingOptions[selectedLokasi].forEach(function(kavling) {
                const option = document.createElement('option');
                option.value = kavling;
                option.text = kavling;
                kavlingSelect.appendChild(option);
            });
        }

        // Set pilihan kavling yang sudah ada sebelumnya (jika ada)
        kavlingSelect.value = "{{ old('kavling', $foto->data->kavling) }}";
    });

    function previewImage() {
        const preview = document.querySelector('.img-preview');
        const fileInput = document.querySelector('#photo');

        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // Pemanggilan fungsi untuk menampilkan pilihan kavling yang sesuai dengan lokasi yang sudah ada sebelumnya (jika ada)
    document.getElementById('lokasi').dispatchEvent(new Event('change'));
</script>
@endsection
