@extends('layout.dashboard.main')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.12.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.12.0/js/bootstrap-datepicker.min.js"></script>

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Edit Data Legalitas</h2>
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
            <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control datepicker @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk', $legalitas->tgl_masuk) }}" required>
            @error('tgl_masuk')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
            <input type="date" class="form-control datepicker @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" id="tgl_keluar" value="{{ old('tgl_keluar', $legalitas->tgl_keluar) }}" required>
            @error('tgl_keluar')
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

    // Initialize the datepickers
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Customize the date format if needed
            autoclose: true,
            todayHighlight: true,
            // You can add more options here based on your requirements
        });
    });
</script>
@endsection
