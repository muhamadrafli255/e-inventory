@extends('layouts.auth')

@section('authcontent')
    
<div class="container">
    <div class="card form-login">
        <div class="card-body">
          <img src="img/logo.png" class="logo">
          <h2 class="card-title text-center text-white mt-3 mb-5 fw-bold">E - Inventaris</h2>
          <h2 class="card-title text-center text-white mt-5 fw-bold">Registration Page!</h2>
          <div class="col-12 col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <form action="/register" method="POST">
            @csrf
                <div class="input-container">
                    <input type="text" name="name" class="form-control form-input mt-3 @error('name') is-invalid @enderror" placeholder="&#xf007;  Nama lengkap" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-container">
                    <input type="email" name="email" class="form-control form-input @error('email') is-invalid @enderror" placeholder="&#xf0e0;  Alamat Email" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-container">
                    <select name="userclass_id" class="form-control form-input form-select" required>
                        <option selected>&#xf52b;  Asal Kelas</option>
                        @foreach ($class as $c)
                        <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-container">
                    <input type="password" name="password" class="form-control form-input @error('password') is-invalid @enderror" placeholder="&#xf023;  Password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                </div>
                <div class="input-container">
                    <input type="password" name="confirmation" id="confirmation" class="form-control form-input mb-3 @error('confirmation') is-invalid @enderror" placeholder="&#xf023;  Konfirmasi Password" required>
                    @error('confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-outline-light text-center fw-bold btn-lg btn-regist" type="submit">Register!</button>
                </div>
          </form>
          </div>
          <h4 class="text-center fw-bold text-light">Already have an account?</h4>
          <h5 class="text-center"><a class="fw-bold text-light" href="/">Login Here!</a></h5>
        </div>
      </div>
</div>

@endsection