@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Data Baru</h2>
    <form action="{{ route('data.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama User</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user_id" required>
                <option value="">Pilih Nama User</option>
                @foreach ($users as $user)
                @if ($user->role !== 'admin' && $user->role !== 'petugas')
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endif
                @endforeach
            </select>                      
            @error('user_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" required>
                <option value="">Pilih Lokasi</option>
                <option value="DJAGAD LAND BATU" {{ old('lokasi') == 'DJAGAD LAND BATU' ? 'selected' : '' }}>DJAGAD LAND BATU</option>
                <option value="DJAGAD LAND SINGHASARI" {{ old('lokasi') == 'DJAGAD LAND SINGHASARI' ? 'selected' : '' }}>DJAGAD LAND SINGHASARI</option>
                <option value="DPARK CITY" {{ old('lokasi') == 'DPARK CITY' ? 'selected' : '' }}>DPARK CITY</option>
            </select>
            @error('lokasi')
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
            <label for="ptb" class="form-label">PTB</label>
            <input type="text" class="form-control @error('spk') is-invalid @enderror" id="ptb" name="ptb" value="{{ old('ptb') }}" required>
            @error('ptb')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga_deal" class="form-label">Harga Deal</label>
            <input type="number" class="form-control @error('cicilan') is-invalid @enderror" id="harga_deal" name="harga_deal" value="{{ old('harga_deal') }}" required>
            @error('harga_deal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="progres" class="form-label">Progres (%)</label>
            <input type="number" class="form-control @error('progres') is-invalid @enderror" id="progres" name="progres" value="{{ old('progres') }}" required>
            @error('progres')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="sales" class="form-label">Sales</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="sales" name="sales" value="{{ old('sales') }}" required>
            @error('sales')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ktp" class="form-label @error('photo') is-invalid @enderror">KTP</label>
            <div>
                <input class="form-control" type="file" id="ktp" name="ktp[]" onchange="previewImages()" multiple>
            </div>
            @error('ktp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <!-- Tambahkan elemen img-preview di sini -->
            <div class="img-preview-container mt-2" id="preview-container" style="display: flex; flex-wrap: wrap;"></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    function previewImages() {
        const previewContainer = document.querySelector('#preview-container');
        const files = document.querySelector('#ktp').files;

        previewContainer.innerHTML = ''; // Clear previous previews

        for (const file of files) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            
            const imgPreviewContainer = document.createElement('div');
            imgPreviewContainer.className = 'img-preview-container mr-2 mb-2';
            imgPreviewContainer.style.flexBasis = '20%';
            imgPreviewContainer.appendChild(img);

            previewContainer.appendChild(imgPreviewContainer);
        }
    }
</script>
@endsection