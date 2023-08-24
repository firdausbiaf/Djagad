@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Stok Baru</h2>
    <form action="{{ route('stok-singhasari.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="kluster" class="form-label">Cluster</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" id="kluster" name="kluster" @readonly(true)>
                <option value="1" {{ old('kluster') == '1' ? 'selected' : '' }}>1</option>
            </select>
            @error('kluster ')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kavling" class="form-label">Kavling</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="kavling" name="kavling" value="{{ old('kavling') }}" required>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        {{-- <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="kavling" name="kavling" required>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required>
            @error('keterangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

