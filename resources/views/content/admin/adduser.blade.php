@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-me ml-5">{{ $title }}</h2>
            <h6 class="text-secondary ml-5 mb-4">Silahkan isi semua data!</h6>
        </div>
        <form action="/user/tambah" method="POST">
            @csrf
            <div class="container rounded bg-white ml-5 mt-5 mb-5 ml-5 col-11 border border-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right text-me fw-bold">Formulir tambah data</h4>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels fw-bold">Nama</label><input
                                        type="text" name="name"
                                        class="form-me form-control border border-primary @error('name') is-invalid @enderror"
                                        placeholder="" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels fw-bold">Email</label><input
                                        type="text" name="email"
                                        class="form-me form-control border border-primary @error('email') is-invalid @enderror"
                                        placeholder="" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"><label class="labels fw-bold">Kelas</label><select name="userclass_id" class="form-me form-select border border-primary fw-light fs-6">
                                    @foreach ($userclasses as $userclass)
                                    <option value="{{ $userclass->id }}">{{ $userclass->class_name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels fw-bold">Password</label><input
                                        type="text" name="password"
                                        class="form-me form-control border border-primary @error('password') is-invalid @enderror"
                                        placeholder="" value="{{ old('password') }}" required>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-me text-light" type="submit"><span class="fas fa-pencil"></span> Tambah</button><a href="/dashboard"><button class="btn btn-danger ml-3 text-light" type="button"><span class="fas fa-ban"></span> Batal</button></a></div>
        </form>

        @endsection
