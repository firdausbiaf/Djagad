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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach ($data as $item)
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-{{ $item->id }}" data-toggle="tab" href="#content-{{ $item->id }}" role="tab" aria-controls="content-{{ $item->id }}" aria-selected="false">{{ $item->kavling }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content mt-4" id="myTabContent">
                                    @foreach ($data as $item)
                                        <div class="tab-pane fade @if($loop->first) show active @endif" id="content-{{ $item->id }}" role="tabpanel" aria-labelledby="tab-{{ $item->id }}">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Data Pembeli Kavling {{ $item->kavling }}</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive col-lg-10 mx-5 mt-4">
                                                        <h2>Data User</h2><br>
                                                        <table class="table table-striped table-sm">
                                                            <tr>
                                                                <th scope="row">Nama User</th>
                                                                <td>{{ $item->user->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Telepon</th>
                                                                <td>{{ $item->user->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Alamat</th>
                                                                <td>{{ $item->alamat }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Tipe</th>
                                                                <td>{{ $item->tipe }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">SPK</th>
                                                                <td>{{ $item->spk }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Progres (%)</th>
                                                                <td>{{ $item->progres }} %</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Cicilan</th>
                                                                <td>{{ $item->cicilan }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Foto Section -->
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Progress</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive col-lg-10 mx-5 mt-4">
                                            <h2>Foto Progress</h2><br>
                                            <div class="row">
                                                @foreach($foto->reverse()->take(4) as $f)
                                                    <div class="col-lg-6 mb-3">
                                                        <img src="{{ asset('storage/' . $f->photo) }}" class="card-img-top" alt="Foto" style="max-width: 70%; height: auto;">
                                                    </div>
                                                @endforeach
                                            </div>
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

    <!-- Script JavaScript langsung di dalam file index -->
    <script>
        $(document).ready(function() {
            // Tangani peristiwa klik pada tab
            $('.nav-tabs a.nav-link').on('click', function(e) {
                e.preventDefault(); // Mencegah perubahan URL ketika tab diklik
    
                // Hilangkan kelas 'active' dari semua tab
                $('.nav-tabs a.nav-link').removeClass('active');
    
                // Tambahkan kelas 'active' pada tab yang diklik
                $(this).addClass('active');
    
                // Ambil ID konten tab yang sesuai dari atribut href
                const targetContentId = $(this).attr('href');
    
                // Tampilkan konten tab yang sesuai dan sembunyikan konten lainnya
                $('.tab-content .tab-pane').removeClass('show active');
                $(targetContentId).addClass('show active');
            });
        });
    </script>

    @include('layout.bar.scripts')
    @endsection
