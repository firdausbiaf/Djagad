@extends('layout.login')
@section('content')

<div class="login-dark" style="height: 695px;">
    @if (session()->has('loginError'))
        {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> --}}
        <script>
          $(document).ready(function(){
            $(".modal-title").text("Login Gagal!");
            $(".modal-body p").text("{{ session('loginError') }}");
            $("#myModal").modal('show');
          });
        </script>
        @endif
    <form action="/register" method="post">
        @csrf
        <h2 class="sr-only">Register Form</h2>
        <div class="illustration"><i class="icon ion-ios-filing-outline"></i></div>
        
        <div class="form-group">
          <input type="text" id="name" class="form-control @error('name') is-invalid 
                        @enderror" name="name" placeholder="Name" value="{{ old('name') }}"/>
            
                        @error('name')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
        </div>
        <div class="form-group">
            <input type="phone" id="phone" class="form-control @error('phone') is-invalid                        
                        @enderror" name="phone"  placeholder="Phone Number" value="{{ old('phone') }}"/>
                    
                        @error('phone')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
        </div>
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
            <button class="btn btn-primary btn-block" type="submit">Register</button>
        </div>
        <a class="forgot" href="/login">Have any account?</a></form>
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

</div>
    
@endsection