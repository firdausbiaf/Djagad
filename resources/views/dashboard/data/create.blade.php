@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Data Baru</h2>
    <form action="{{ route('data.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama User</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user_id" required>
                <option value="">Pilih Nama User</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
            @error('alamat')
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
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="number" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" value="{{ old('tipe') }}" required>
            @error('tipe')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="spk" class="form-label">SPK</label>
            <input type="text" class="form-control @error('spk') is-invalid @enderror" id="spk" name="spk" value="{{ old('spk') }}" required>
            @error('spk')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="progres" class="form-label">Progres</label>
            <input type="number" class="form-control @error('progres') is-invalid @enderror" id="progres" name="progres" value="{{ old('progres') }}" required>
            @error('progres')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cicilan" class="form-label">Cicilan</label>
            <input type="number" class="form-control @error('cicilan') is-invalid @enderror" id="cicilan" name="cicilan" value="{{ old('cicilan') }}" required>
            @error('cicilan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="photo" class="form-label @error('photo') is-invalid @enderror">Foto Progress</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input class="form-control" type="file" id="photo" name="photo" onchange="previewImage()">
          @error('photo')
          <div class="invalid-feedback">
          {{ $message }}
          </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
