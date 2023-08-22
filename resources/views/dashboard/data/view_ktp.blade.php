@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 40rem;">
            <div class="card-header">
                Detail KTP
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <b>Foto KTP :</b><br><br>
                        @php
                            $ktpPhotos = json_decode($data->ktp); // Assuming $data->ktp is a JSON-encoded array of photo paths
                        @endphp

                        <div class="row">
                            @foreach ($ktpPhotos as $index => $ktpPhoto)
                                <div class="col-md-6 mb-3">
                                    <div class="photo-container">
                                        <img class="img-fluid" src="{{ asset('storage/'.$ktpPhoto) }}" alt="KTP Photo {{ $index + 1 }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('data.index') }}">Kembali</a>
        </div>
    </div>
</div>

<style>
    .photo-container {
        padding: 5px; /* Adjust this value for the desired spacing */
    }
</style>
@endsection
