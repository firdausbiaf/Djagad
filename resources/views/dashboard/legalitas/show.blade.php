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
                    <li class="list-group-item"><b>No. : </b>{{ $legalitas->id }}</li>
                    <li class="list-group-item"><b>Nomor : </b>{{ $legalitas->nomor }}</li>
                    <li class="list-group-item"><b>Uang Masuk : </b>{{ $legalitas->uang_masuk }}</li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('legalitas.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
