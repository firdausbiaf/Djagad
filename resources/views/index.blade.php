@extends('layout.main')

@section('content')

<!-- Carousel Start -->
<div class="container-fluid">
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
                            <!-- Nav tabs for kavling -->
                            <ul class="nav nav-tabs" id="kavlingTab" role="tablist">
                                @foreach ($data as $item)
                                    <li class="nav-item">
                                        <a class="nav-link" id="kavling-tab-{{ $item->id }}" data-toggle="tab" href="#content-{{ $item->id }}" role="tab" aria-controls="content-{{ $item->id }}" aria-selected="false">{{ $item->kavling }}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Tab panes for kavling -->
                            <div class="tab-content mt-4" id="kavlingTabContent">
                                @foreach ($data as $item)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="content-{{ $item->id }}" role="tabpanel" aria-labelledby="kavling-tab-{{ $item->id }}">
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
                                                            <th scope="row">Kavling</th>
                                                            <td>{{ $item->kavling }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Lokasi</th>
                                                            <td>{{ $item->lokasi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Tipe</th>
                                                            <td>{{ $item->tipe }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Harga Deal</th>
                                                            <td>{{ $item->harga_deal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Cicilan Ke</th>
                                                            <td>{{ $item->cicilan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Uang Masuk</th>
                                                            <td>{{ $item->uang_masuk }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <th scope="row">SPK</th>
                                                            <td>{{ $item->spk }}</td>
                                                        </tr> --}}
                                                        <tr>
                                                            <th scope="row">Progres (%)</th>
                                                            <td>{{ $item->progres }} %</td>
                                                        </tr>
                            
                                                    </table>
                                                    <h4 class="medium font-weight-bold"> Progress Pembangunan <span class="float-right">{{ $item->progres }}%</span></h4>
                                                    <div class="progress mb-4">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $item->progres }}%" aria-valuenow="{{ $item->progres }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <h4 class="medium font-weight-bold">Progress Cicilan ({{ $item->uang_masuk }} / {{ $item->harga_deal }})</h4>
                                                            @php
                                                                $progressCicilan = ($item->uang_masuk / $item->harga_deal) * 100;
                                                            @endphp
                                                            <div class="progress mb-4">
                                                                <div class="progress-bar" id="cicilan-progress" role="progressbar" style="width: {{ $progressCicilan }}%" aria-valuenow="{{ $progressCicilan }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    `<div class="row">

                    <div class="col-lg-6 mb-4">
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
                                    <div class="table-responsive col-md-10 mx-5 mt-4">
                                        <h2>Foto Progress</h2><br>
                                        <!-- Nav tabs for foto -->
                                        {{-- <ul class="nav nav-tabs" id="fotoTab" role="tablist">
                                            @foreach ($data as $item)
                                                <li class="nav-item">
                                                    <a class="nav-link" id="foto-tab-{{ $item->id }}" data-toggle="tab" href="#foto-content-{{ $item->id }}" role="tab" aria-controls="foto-content-{{ $item->id }}" aria-selected="false">{{ $item->kavling }}</a>
                                                </li>
                                            @endforeach
                                        </ul> --}}

                                        <!-- Tab panes for foto -->
                                        <div class="tab-content mt-4" id="fotoTabContent">
                                            @foreach ($data as $item)
                                                <div class="tab-pane fade" id="foto-content-{{ $item->id }}" role="tabpanel" aria-labelledby="foto-tab-{{ $item->id }}">
                                                    @php
                                                        $itemFoto = $foto->where('data_id', $item->id)->sortByDesc('created_at')->take(4);
                                                    @endphp
                                                    <div class="row">
                                                        @foreach($itemFoto as $f)
                                                            <div class="col-lg-6 mb-3">
                                                                <img src="{{ asset('storage/' . $f->photo) }}" class="card-img-top" alt="Foto" style="max-width: 70%; height: auto;">
                                                            </div>
                                                        @endforeach
                                                    </div>
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

<script>
    
    $(document).ready(function() {
        // Ambil elemen tab pertama untuk kavling dan foto
        const firstKavlingTab = $('#kavlingTab .nav-link:first');
        const firstFotoTab = $('#fotoTab .nav-link:first');
        const firstProgresTab = $('#progresTab .nav-link:first')

        // Tambahkan kelas 'active' pada tab pertama secara manual saat memuat halaman
        firstKavlingTab.addClass('active');
        firstFotoTab.addClass('active');
        firstProgresTab.addClass('active');

        // Tampilkan konten tab pertama saat halaman dimuat
        $('#kavlingTabContent .tab-pane:first').addClass('show active');
        $('#fotoTabContent .tab-pane:first').addClass('show active');
        $('#progresTabContent .tab-pane:first').addClass('show active');

        // Fungsi untuk menampilkan foto berdasarkan kavling yang dipilih
        function showFotoByKavling(kavlingId) {
            // Sembunyikan semua foto
            $('#fotoTabContent .tab-pane').removeClass('show active');

            // Tampilkan foto yang sesuai dengan kavlingId yang dipilih
            $('#foto-content-' + kavlingId).addClass('show active');
        }

        // Saat halaman dimuat, tampilkan foto berdasarkan tab pertama yang aktif
        showFotoByKavling(firstKavlingTab.attr('href').replace('#content-', ''));

        // Fungsi untuk menampilkan progress berdasarkan kavling yang dipilih
        function showProgresByKavling(kavlingId) {
            // Ambil progress value berdasarkan kavlingId yang dipilih
            const progress = $('#content-' + kavlingId + ' .progress-value').text();

            // Update progress value on the progress bar
            $('#progress-bar-' + kavlingId).css('width', progress + '%');
            $('#progress-bar-' + kavlingId).attr('aria-valuenow', progress);
        }

        // Saat halaman dimuat, tampilkan progress berdasarkan tab pertama yang aktif
        const firstKavlingTabId = firstKavlingTab.attr('href').replace('#content-', '');
        showProgresByKavling(firstKavlingTabId);

        // Tangani peristiwa klik pada tab kavling
        $('#kavlingTab .nav-link, #fotoTab .nav-link, #progresTab .nav-link').on('click', function(e) {
            e.preventDefault();

            // Hilangkan kelas 'active' dari semua tab kavling
            $('#kavlingTab .nav-link, #fotoTab .nav-link, #progresTab .nav-link').removeClass('active');

            // Tambahkan kelas 'active' pada tab kavling yang diklik
            $(this).addClass('active');

            // Ambil ID konten tab kavling yang sesuai dari atribut href
            const targetContentId = $(this).attr('href');

            // Sembunyikan semua konten tab kavling
            $('#kavlingTabContent .tab-pane').removeClass('show active');

            // Tampilkan konten tab kavling yang sesuai
            $('#kavlingTabContent .tab-pane, #fotoTabContent .tab-pane, #progresTabContent .tab-pane').removeClass('show active');

            // Tampilkan konten tab yang sesuai
            $(targetContentId).addClass('show active');

            // Ambil kavlingId dari atribut href dan tampilkan foto serta progres sesuai tab yang dipilih
            const kavlingId = targetContentId.replace('#content-', '');
            showFotoByKavling(kavlingId);
            showProgresByKavling(kavlingId);
        });
    });
</script>

@include('layout.bar.scripts')
@endsection
