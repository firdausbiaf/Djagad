@extends('layout.main')

@section('content')

<!-- Carousel Start -->
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-3 text-white">Djagad Land Group</h1>
            <h3 class="text-white text-uppercase mb-3">Pilihan Investasi Terbaik</h3>
            @if(auth()->check() == 0)
                <p class="fs-5 text-white mb-4 pb-2">PT JAGAD KARYA UTAMA  adalah Developer Rumah yang terpercaya dengan nomer 
                    TDP 132516801408 dan telah terdaftar sebagai anggota Asosiasi Pengembang Perumahan dan 
                    Pemukiman Seluruh Indonesia (APERSI) dengan NIA: 04.18.0777. telah sukses membangun perumahan dengan Konsep 
                    Rumah Villa di Kabupaten Malang dan Kota Batu Selain di Indonesia</p>
            @endif
            
            @auth
                @if(auth()->user()->role == "member" && $data)
                    <div class="row">
            
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">
        
                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pembeli</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive col-lg-10 mx-5 mt-4">
                                        <h2>Data User</h2><br>
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama User</th>
                                                    <th scope="col">Telepon</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">Kavling</th>
                                                    <th scope="col">Tipe</th>
                                                    <th scope="col">SPK</th>
                                                    <th scope="col">Progres (%)</th>
                                                    <th scope="col">Cicilan</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $data->user->name }}</td>
                                                    <td>{{ $data->user->phone }}</td>
                                                    <td>{{ $data->alamat }}</td>
                                                    <td>{{ $data->kavling }}</td>
                                                    <td>{{ $data->tipe }}</td>
                                                    <td>{{ $data->spk }}</td>
                                                    <td>{{ $data->progres }}%</td>
                                                    <td>{{ $data->cicilan }}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Section -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive col-lg-10 mx-5 mt-4">
                                        <h2>Foto</h2><br>
                                        @foreach($foto->reverse()->take(4) as $f)
                                            <img src="{{ asset('storage/' . $f->photo) }}" class="card-img-top" alt="Foto">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>

@include('layout.bar.scripts')
@endsection
