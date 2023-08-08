@extends('layout.dashboard.main')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
              <div class="row">
                <div class="col-sm-12">
                  <div class="statistics-details d-flex align-items-center justify-content-between">
                    <div>
                      <p class="statistics-title">Member</p>
                      <h4 class="rate-percentage">{{ $member->count() }} Persons</h4>
                      
                    </div>
                    <div>
                      <p class="statistics-title">Admin</p>
                      <h4 class="rate-percentage">{{ $admin->count() }} Persons</h4>
                      
                    </div>
                    <div>
                      <p class="statistics-title">Petugas</p>
                      <h4 class="rate-percentage">{{ $petugas->count() }} Persons</h4>
                      
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Data User</p>
                      <h4 class="rate-percentage">{{ $data->count() }} Data</h4>
                      
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Legalitas</p>
                      <h4 class="rate-percentage">{{ $legalitas->count() }} Data</h4>
                      
                    </div>
                  </div>
                </div>
              </div> 
                <div>
                  <img src="{{ asset('images\thumbnail.webp') }}" height="auto" width="100%">
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 

@endsection