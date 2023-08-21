@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail KTP
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <b>Foto KTP :</b><br><br>
                        @php
                            $ktpPhotos = explode(',', $data->ktp); // Assuming $data->ktp is a comma-separated list of photo paths
                        @endphp

                        <div class="row">
                            @php
                                $maxPhotos = min(count($ktpPhotos), 10); // Set maximum photos to display
                            @endphp
                            
                            @for ($index = 0; $index < $maxPhotos; $index++)
                                <div class="col-md-6 mb-3">
                                    <img width="200" height="200" src="{{ asset('storage/'.$ktpPhotos[$index]) }}" alt="KTP Photo {{ $index + 1 }}">
                                </div>
                            @endfor
                        </div>
                    </li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('data.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
