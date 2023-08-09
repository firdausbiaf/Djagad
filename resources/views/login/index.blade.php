@extends('layout.login')
@section('content')

<div class="login-dark" style="height: 0vh;">
  <form action="/login" method="post">
    @csrf
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
    <script>
      $(document).ready(function(){
        $(".modal-title").text("Login Error!");
        $(".modal-body p").text("{{ session('loginError') }}");
        $("#myModal").modal('show');
      });
    </script>
    @endif
    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        {{-- <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol> --}}
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid"
                                    src="https://www.djagadland.com/wp-content/uploads/2021/09/Type-57-1-600x450.jpg" alt="First slide">
                                    <div class="carousel-caption">
                                      <h1 class="display-3 text-white">Djagad Land Group</h1>
                                      <h3 class="text-white text-uppercase mb-3">Pilihan Investasi Terbaik</h3>
                                    </div>
                                    <style>
  /* ... Your existing styles ... */
  
  .carousel-item.active img {
    width: 100%;
    height: 500px; /* Set the desired height */
    object-fit: cover; /* This ensures the image maintains its aspect ratio */
  }

  .carousel-item::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(84, 101, 252, 0.342); /* Blue color with 0.5 opacity */
  }

  .carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white;
    font-size: 24px;
    font-weight: bold;
  }

  .carousel-caption h1 {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 10px; /* Set the desired font size for h1 */
  }

  .carousel-caption h3 {
    font-size: 25px; /* Set the desired font size for h3 */
  }
</style>
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">
                                        {{-- <h2>This is Heaven</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
                                    {{-- </div>
                                </div>
                            </div>
                            <div class="carousel-item"> --}}
                                {{-- <img class="d-block img-fluid"
                                    src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg"
                                    alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text"> --}}
                                        {{-- <h2>This is Heaven</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
                                    {{-- </div>
                                </div>
                            </div> --}}
                            {{-- <div class="carousel-item">
                                <img class="d-block img-fluid"
                                    src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg"
                                    alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text"> --}}
                                        {{-- <h2>This is Heaven</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 login-sec">
                    <h2 class="text-center">Form Login</h2>
                    <form class="login-form">
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

                    </form>
                    {{-- <div class="copy-text">Created with <i class="fa fa-heart"></i> by Grafreez</div> --}}
                </div>
            </div>
        </div>

    </section>

    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}
    <!-- Modal -->
    <div id="myModal" class="modal fade ">
        <div class="modal-dialog modal-dialog-centered">
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


<style>
  @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
  .login-block {
      background: #395fdb;  /* fallback for old browsers */
      background: -webkit-linear-gradient(to bottom, #d6dffc, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to bottom, #4270ee, #0c245a); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      float: left;
      width: 100%;
      padding: 50px 0;
  }

  .container {
      background: #fff;
      border-radius: 10px;
      box-shadow: 15px 20px 0px rgba(0, 0, 0, 0.1);
  }

  .carousel-inner {
      border-radius: 0 10px 10px 0;
  }

  .carousel-caption {
      text-align: left;
      left: 5%;
  }

  .login-sec {
      padding: 50px 30px;
      position: relative;
  }

  .login-sec .copy-text {
      position: absolute;
      width: 80%;
      bottom: 20px;
      font-size: 13px;
      text-align: center;
  }

  .login-sec .copy-text i {
      color: #c45616;
  }

  .login-sec .copy-text a {
      color: #E36262;
  }

  .login-sec h2 {
      margin-bottom: 30px;
      font-weight: 800;
      font-size: 30px;
      color: #214694;
  }

  .login-sec h2:after {
      content: " ";
      width: 100px;
      height: 5px;
      background: #FEB58A;
      display: block;
      margin-top: 20px;
      border-radius: 3px;
      margin-left: auto;
      margin-right: auto;
  }

  .btn-login {
      background: #0a2681;
      color: #fff;
      font-weight: 600;
  }

  .banner-text {
      width: 70%;
      position: absolute;
      bottom: 40px;
      padding-left: 20px;
  }

  .banner-text h2 {
      color: #fff;
      font-weight: 600;
  }

  .banner-text h2:after {
      content: " ";
      width: 100px;
      height: 5px;
      background: #FFF;
      display: block;
      margin-top: 20px;
      border-radius: 3px;
  }

  .banner-text p {
      color: #fff;
  }

  /* Additional CSS to place the form on the right and the image on the left */
  @media (min-width: 768px) {
    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-md-8 {
        flex: 0 0 66.66667%;
        max-width: 66.66667%;
    }

    .col-md-4 {
        flex: 0 0 33.33333%;
        max-width: 33.33333%;
    }

      /* .col-md-8 {
          flex: 0 0 66.66667%;
          max-width: 66.66667%;
      } */

      .banner-sec {
        border-radius: 0 10px 10px 0;
    }

    .login-sec {
        border-radius: 10px 0 0 10px;
    }

      /* ... Your existing styles ... */

/* Center the modal dialog */
.modal-dialog {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

/* Center the modal content */
.modal-content {
    max-width: 400px;
    width: 100%;
    text-align: center;
}

.carousel-item.active img {
  width: 100%;
  height: 100vh; /* Set the desired height */
  object-fit: cover; /* This ensures the image maintains its aspect ratio */
}
  }
</style>
