@extends('layout.main')

@section('content')

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-12">
        <div class="owl-carousel header-carousel position-fixed">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid image" src="{{ asset('images/background.png') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                {{-- <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Djagad Land Group</h5> --}}
                                <h1 class="display-3 text-white animated slideInDown">Djagad Land Group</h1>
                                <h3 class="text-white text-uppercase mb-3 animated slideInDown">Pilihan Investasi Terbaik</h3>
                                @if(auth()->check() == 0)
                                    <p class="fs-5 text-white mb-4 pb-2">PT JAGAD KARYA UTAMA  adalah Developer Rumah yang terpercaya dengan nomer 
                                        TDP 132516801408 dan telah terdaftar sebagai anggota Asosiasi Pengembang Perumahan dan 
                                        Pemukiman Seluruh Indonesia (APERSI) dengan NIA: 04.18.0777. telah sukses membangun perumahan dengan Konsep 
                                        Rumah Villa di Kabupaten Malang dan Kota Batu Selain di Indonesia</p>
                                @endif
                                
                                @auth
                                    @if(auth()->user()->role == "member" )
                                        @if(auth()->user()->transaksi->count() == 0)
                                            <p class="fs-5 mb-4 pb-2 landing-page">
                                                Anda belum terdaftar bimbel. Klik menu "Bimbel" untuk memilih kelas bimbel yang tersedia.
                                            </p>
                                        @else       
                                            <br><p class="fs-5 text-white mb-4 pb-2">
                                                Anda telah terdaftar pada bimbel :<br>
                                                    @foreach ($transaksinew as $t)
                                                        <ul class="fs-5 text-white mb-4 pb-2">
                                                            <li>{{ $t->course->title }}</li>
                                                        </ul>                                                 
                                                    @endforeach                                                   
                                                <p class="fs-5 mb-4 pb-2 landing-page">Klik menu "My Class" untuk melihat kelas bimbel Anda.</p>
                                            </p>
                                        @endif
                                    @endif
                                    <div class="row">
                                        <!-- Earnings (Monthly) Card Example -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Earnings (Monthly) Card Example -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Earnings (Monthly) Card Example -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col-auto">
                                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="progress progress-sm mr-2">
                                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Users -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-left-warning shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Users') }}</div>
                                                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div> --}}
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="row">
                        
                                        <!-- Content Column -->
                                        <div class="col-lg-6 mb-4">
                        
                                            <!-- Project Card Example -->
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                                                    <div class="progress mb-4">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                                                    <div class="progress mb-4">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                                                    <div class="progress mb-4">
                                                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                                                    <div class="progress mb-4">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <!-- Color System -->
                                            <div class="row">
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card bg-primary text-white shadow">
                                                        <div class="card-body">
                                                            Primary
                                                            <div class="text-white-50 small">#4e73df</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card bg-success text-white shadow">
                                                        <div class="card-body">
                                                            Success
                                                            <div class="text-white-50 small">#1cc88a</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card bg-info text-white shadow">
                                                        <div class="card-body">
                                                            Info
                                                            <div class="text-white-50 small">#36b9cc</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card bg-warning text-white shadow">
                                                        <div class="card-body">
                                                            Warning
                                                            <div class="text-white-50 small">#f6c23e</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card bg-danger text-white shadow">
                                                        <div class="card-body">
                                                            Danger
                                                            <div class="text-white-50 small">#e74a3b</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card bg-secondary text-white shadow">
                                                        <div class="card-body">
                                                            Secondary
                                                            <div class="text-white-50 small">#858796</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                        </div>
                        
                                        <div class="col-lg-6 mb-4">
                        
                                            <!-- Illustrations -->
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/svg/undraw_editable_dywm.svg') }}" alt="">
                                                    </div>
                                                    <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw →</a>
                                                </div>
                                            </div>
                        
                                            <!-- Approach -->
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                                </div>
                                                <div class="card-body">
                                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                                                    <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                                                </div>
                                            </div>
                        
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Carousel End -->

{{-- 
<div class="row">
    <div class="col ">
        <div class="profile">
            <h1 class="fw-bold">FAST</h1>
            <h3>
                Fantastic Smart Institute merupakan lembaga bimbingan belajar<br>untuk siswa SD
                hingga SMP yang berada di Kecamatan Kedungpring,<br>Kabupaten Lamongan, Jawa Timur
            </h3>
            @auth
                @if(auth()->user()->role == "member" )
                    @if(auth()->user()->transaksi->count() == 0)
                        <h3>
                            Anda belum terdaftar bimbel. Klik menu "Bimbel" untuk memilih kelas bimbel yang tersedia.
                        </h3>
                    @else
                        <h3>
                           
                            Anda telah terdaftar pada bimbel : {{ $transaksi->course->title }}<br><br>
                            Klik menu "My Class" untuk melihat kelas bimbel Anda.
                        </h3>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>  --}}
@include('layout.bar.scripts')
@endsection