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
                      <p class="statistics-title">Kelas</p>
                      <h4 class="rate-percentage">{{ $category->count() }} Class</h4>
                      
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Bimbel</p>
                      <h4 class="rate-percentage">{{ $course->count() }} Subjects</h4>
                      
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Transaction</p>
                      <h4 class="rate-percentage">{{ $transaksi->count() }} Transactions</h4>
                      
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