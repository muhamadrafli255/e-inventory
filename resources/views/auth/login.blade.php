@extends('layouts.auth')

@section('authcontent')
    
<div class="container">
    <div class="card form-login">
        <div class="card-body">
          <img src="img/logo.png" class="logo">
          <h2 class="card-title text-center text-white mt-10 mb-9 fw-bold">E - Inventaris</h2>
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center mt-5 mb-5" role="alert">
            {{ session('success') }}
            </div>
          @endif
          @if (session('loginError'))
            <div class="alert alert-danger alert-dismissible fade show text-center mt-5 mb-5" role="alert">
            {{ session('loginError') }}
            </div>
          @endif
          <h2 class="card-title text-center text-white fw-bold mb-8">Login Page!</h2>
          <div class="col-12 col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <form action="/login" method="POST">
            @csrf
                <div class="input-container mb-4">
                    <input type="email" name="email" class="form-control form-input mt-2mb-2 @error('email') is-invalid @enderror" placeholder="&#xf0e0; Email Address" required autofocus>
                    @error('email')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="input-container">
                    <input type="password" name="password" class="form-control form-input mb-5 @error('password') is-invalid @enderror" placeholder="&#xf023; Your Password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <button class="btn btn-outline-light text-center fw-bold btn-lg btn-login" type="submit">Login!</button>
                </div>
          </form>
          </div>
          <h4 class="text-center fw-bold text-light mt-3">Don't have an account?</h4>
          <h5 class="text-center"><a class="fw-bold text-light" href="/register">Register Here!</a></h5>
        </div>
      </div>
</div>

@endsection