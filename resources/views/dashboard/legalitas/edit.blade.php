@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Edit Foto</h2>
    <form action="{{ route('legalitas.update', $legalitas->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="nomor" class="form-label">Nomor</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="nomor" name="nomor" value="{{ old('nomor', $legalitas->nomor) }}" required>
            @error('nomor')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="uang_masuk" class="form-label">Uang Masuk</label>
            <input type="number" class="form-control @error('uang_masuk') is-invalid @enderror" id="uang_masuk" name="uang_masuk" value="{{ old('uang_masuk', $legalitas->uang_masuk) }}" required>
            @error('uang_masuk')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
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
