@extends('layouts.admin.main')

@section('content')

<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-5">Silahkan download data laporan disini!</h6>
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
        <h5 class="text-me fw-bold mb-3">Tabel User</h5>
        <a href="/downloadexceluser"><button class="btn btn-success text-light mt-3 mb-3"><span class="fas fa-file-excel"></span> Download Excel</button></a>
        <a href="/downloadpdfuser"><button class="btn btn-danger text-light mt-3 mb-3"><span class="fas fa-file-pdf"></span> Download PDF</button></a>
        <table id="myTable" class="table table-bordered">
            <thead class="text-me">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Kelas</th>
                <th scope="col">No. Telp</th>
                <th scope="col">Alamat</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->userclass->class_name }}</td>
                <td>{{ $user->number_phone }}</td>
                <td>{{ $user->address }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
</div>
</div>

<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-13 col-md-12 col-sm-6 col-xs-12 col-lg-12">
<div class="card bg-tb">
    <div class="card-body table-responsive">
        <h5 class="text-me fw-bold mb-3">Tabel Peminjaman</h5>
        <a href="/downloadexcelloans"><button class="btn btn-success text-light mt-3 mb-3"><span class="fas fa-file-excel"></span> Download Excel</button></a>
        <a href="/downloadpdfloans"><button class="btn btn-danger text-light mt-3 mb-3"><span class="fas fa-file-pdf"></span> Download PDF</button></a>
        <table id="myTable" class="table table-bordered">
            <thead class="text-me">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Peminjaman</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Status Peminjaman</th>
                <th scope="col">Tujuan Peminjaman</th>
                <th scope="col">Tanggal Peminjaman</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $loan->loans_code }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->goods->name }}</td>
                <td>{{ $loan->statusLoans->name }}</td>
                <td>{{ $loan->purpose }}</td>
                <td>{{ $loan->created_at }}</td>
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