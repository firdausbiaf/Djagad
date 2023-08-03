@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Data Legalitas Baru</h2>
    <form action="{{ route('legalitas.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nomor" class="form-label">Nomor</label>
            <input type="text" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" value="{{ old('nomor') }}" required>
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
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="text" class="form-control datepicker @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" id="tanggal_masuk" required>
            @error('tanggal_masuk')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
            <input type="text" class="form-control datepicker @error('tanggal_keluar') is-invalid @enderror" name="tanggal_keluar" id="tanggal_keluar" required>
            @error('tanggal_keluar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    // Assuming you have already added the necessary Bootstrap and Bootstrap Datepicker JS files

    // Initialize the datepicker for the entry date field
    $(document).ready(function() {
        $('#tanggal_masuk').datepicker({
            format: 'yyyy-mm-dd', // Customize the date format if needed
            autoclose: true,
            todayHighlight: true,
            // You can add more options here based on your requirements
        });
    });

    // Initialize the datepicker for the exit date field
    $(document).ready(function() {
        $('#tanggal_keluar').datepicker({
            format: 'yyyy-mm-dd', // Customize the date format if needed
            autoclose: true,
            todayHighlight: true,
            // You can add more options here based on your requirements
        });
    });
</script>

@endsection
