@extends('layout.login')
@section('content')

<div class="login-dark" style="height: 695px;">
    <form action="/login" method="post">
        @csrf
        <h2 class="sr-only">Login Form</h2>
        <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
        @if (session()->has('success'))
        {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> --}}
        <script>
          $(document).ready(function(){
            $(".modal-title").text("{{ session('success') }}");
            $(".modal-body p").text("Dimohon Menunggu Verifikasi Akun Dari Admin Maksimal 1x24 Jam");
            $("#myModalSuccess").modal('show');
          });
        </script>
        @endif

        @if (session()->has('loginError'))
        {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> --}}
        <script>
          $(document).ready(function(){
            $(".modal-title").text("Login Error!");
            $(".modal-body p").text("{{ session('loginError') }}");
            $("#myModal").modal('show');
          });
        </script>
        @endif
        
        <div class="form-group">
            <input type="email" id="email" class="form-control @error('email') is-invalid                        
                        @enderror" name="email"  placeholder="Email" value="{{ old('email') }}"/>
                    
                        @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
        </div>
        <div class="form-group">
            <input type="password" id="password" class="form-control @error('password') is-invalid                        
                        @enderror" name="password"  placeholder="Password" />
                    
                        @error('password')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Log In</button>
        </div>
        <a class="forgot" href="/register">Don't have any account?</a>
      </form>
        
 <!-- Button trigger modal -->
 {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}
<!-- Modal -->
<div id="myModal" class="modal fade ">
  <div class="modal-dialog">
      <div class="modal-content ">
          <div class="modal-header bg-warning">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
      <p></p>
      
          </div>
      </div>
  </div>
</div>

<div id="myModalSuccess" class="modal fade ">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content ">
          <div class="modal-header bg-success">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
      <p></p>
      
          </div>
      </div>
  </div>
</div>

</div>
    
@endsection