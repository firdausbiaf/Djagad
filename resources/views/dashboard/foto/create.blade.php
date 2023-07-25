@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Foto Baru</h2>
    <form action="{{ route('foto.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="data_id" class="form-label">Kavling</label>
            <select class="form-select @error('data_id') is-invalid @enderror" name="data_id" id="data_id" required>
                <option value="">Pilih Kavling</option>
                @foreach ($data as $id => $kavling)
                    <option value="{{ $id }}" {{ old('data_id') == $id ? 'selected' : '' }}>
                        {{ $kavling }}
                    </option>
                @endforeach
            </select>
            @error('data_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label @error('photo') is-invalid @enderror">Foto</label>
            <div>
                <input class="form-control" type="file" id="photo" name="photo[]" onchange="previewImage()" multiple>
            </div>
            @error('photo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
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
</script>
@endsection
