@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-5">Silakan pilih data yang akan diedit!</h6>
</div>
@if (session('success'))
<div class="ml-3 col-12 alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
<div class="container-fluid">
  <div class="row">
    <div class="col-13 col-md-12 col-sm-6 col-xs-12 col-lg-12">
<div class="card bg-tb">
    <div class="card-body table-responsive">
        <h5 class="text-me fw-bold mb-3">Tabel Peminjaman</h5>
        <table id="myTable" class="table table-bordered">
            <thead class="text-me">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode peminjaman</th>
                <th scope="col">Nama peminjam</th>
                <th scope="col">Kelas peminjam</th>
                <th scope="col">Nama barang</th>
                <th scope="col">Opsi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($dtLoans as $l)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $l->loans_code }}</td>
                <td>{{ $l->user->name }}</td>
                <td>{{ $l->user->userClass->class_name }}</td>
                <td>{{ $l->goods->name }}</td>
                <td><a href="/peminjaman/edit/{{ $l->id }}"><button class="btn btn-me text-light mt-2" type="button"><span class="fas fa-pencil"></span> Edit</button></a></td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
</div>
</div>
@endsection