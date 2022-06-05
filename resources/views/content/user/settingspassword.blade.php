@extends('layouts.user.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12 mt-3">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-4">Hallo {{ auth()->user()->name }}</h6>
</div>

@if (session('success'))
<div class="ml-3 col-md-12 alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

<form action="/pengaturanpassworduser/{{ auth()->user()->id }}" method="POST">
    @method('put')
    @csrf
<div class="container rounded bg-white ml-5 mt-5 mb-5 ml-5 col-11 border border-primary">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @if (auth()->user()->image == null)
                <img class="border border-primary img-thumbnail" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                @else   
                <img class="border border-primary img-thumbnail" width="150px" src="{{ asset('storage/' . auth()->user()->image) }}">
                @endif
                <span class="font-weight-bold text-me">{{ auth()->user()->name }}</span><span class="text-black-50">{{ auth()->user()->email }}</span><span> </span></div>
        </div>
        <div class="col-md-12">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right text-me fw-bold">{{ $title }}</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels fw-bold">Password Lama</label><input type="password" name="password" class="form-control border border-primary @error('password') is-invalid @enderror">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels fw-bold">Password Baru</label><input type="password" name="new_password" class="form-control border border-primary @error('new_password') is-invalid @enderror">
                        @error('new_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels fw-bold">Konfirmasi Password Baru</label><input type="password" name="confirm_password" class="form-control border border-primary @error('confirm_password') is-invalid @enderror">
                        @error('confirm_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-me text-light" type="submit">Save Password</button></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</form>
@endsection