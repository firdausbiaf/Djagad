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
              <div class="row">
                <div class="col-sm-6">
                  <canvas id="personChart" width="300" height="150"></canvas>
                </div>
                <div class="col-sm-6">
                  <canvas id="dataChart" width="300" height="150"></canvas>
                </div>
              </div>
              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
              <script>
                // Ambil referensi ke elemen canvas untuk grafik persons
                var personCtx = document.getElementById('personChart').getContext('2d');
                
                // Data untuk grafik persons
                var personData = {
                  labels: ['Member', 'Admin', 'Petugas'],
                  datasets: [{
                    label: 'Total Persons',
                    data: [{{ $member->count() }}, {{ $admin->count() }}, {{ $petugas->count() }}],
                    backgroundColor: ['red', 'green', 'orange']
                  }]
                };
                
                // Konfigurasi grafik persons
                var personConfig = {
                  type: 'bar',
                  data: personData,
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                };
                
                // Buat grafik persons
                var personChart = new Chart(personCtx, personConfig);
                
                // Ambil referensi ke elemen canvas untuk grafik data
                var dataCtx = document.getElementById('dataChart').getContext('2d');
                
                // Data untuk grafik data
                var dataData = {
                  labels: {!! json_encode(['Data User', 'Legalitas']) !!},
                  datasets: [{
                    label: 'Total Data',
                    data: [{{ $data->count() }}, {{ $legalitas->count() }}],
                    backgroundColor: ['blue', 'purple']
                  }]
                };
                
                // Konfigurasi grafik data
                var dataConfig = {
                  type: 'bar',
                  data: dataData,
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                };
                
                // Buat grafik data
                var dataChart = new Chart(dataCtx, dataConfig);
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection