@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail Foto
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>ID : </b>{{ $foto->id }}</li>
                    <li class="list-group-item"><b>Kavling : </b>{{ $foto->data->kavling }}</li>
                    <li class="list-group-item"><b>Foto Progress : </b><br><br><img width="370px" src="{{ asset('storage/'.$foto->photo) }}"></li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('foto.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
