@extends('layouts.admin.main')

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

<form action="/updateakun/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
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
            <div class="form-group col-3 mx-auto">
                <label class="text-center fw-bold" for="image">Silahkan upload foto profile baru</label>
                <img class="img-preview img-fluid mb-3">
                <input type="file" name="image" class="form-control-file border border-secondary mb-4 @error('image') is-invalid @enderror" id="image" onchange="previewImage()">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right text-me fw-bold">Pengaturan Akun</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels fw-bold">Nama</label><input type="text" class="form-control border border-primary @error('name') is-invalid @enderror" placeholder="full name" value="{{ auth()->user()->name }}"></div>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Email</label><input type="text" class="form-control border border-primary @error('email') is-invalid @enderror" placeholder="enter address line 1" value="{{ auth()->user()->email }}" readonly>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12"><label class="labels fw-bold">Kelas</label><select name="userclass_id" class="form-me form-select border border-primary fw-light fs-6">
                            <option value="{{ auth()->user()->userclass_id }}">{{ $user->userClass->class_name }}</option>
                            @foreach ($userclasses as $u)
                            <option value="{{ $u->id }}">{{ $u->class_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">No. Telp</label><input type="text" class="form-control border border-primary @error('number_phone') is-invalid @enderror" name="number_phone" value="{{ auth()->user()->number_phone }}">
                        @error('number_phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Alamat</label><input type="text" class="form-control border border-primary @error('address') is-invalid @enderror" name="address" value="{{ auth()->user()->address }}">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-me text-light" type="submit">Save Profile</button></div>
                <div class="mt-3 text-center"><a href="/pengaturanpassword/{{ auth()->user()->id }}"><button class="btn btn-me text-light" type="button"><span class="fas fa-lock"></span> Pengaturan Password</button></a></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</form>
@endsection