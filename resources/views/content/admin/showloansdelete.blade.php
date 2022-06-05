@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-5">Silakan pilih data yang akan dihapus!</h6>
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
                <td><button class="btn btn-danger mt-2" type="button" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $l->id }}"><span class="fas fa-ban"></span> Hapus</button>

                {{-- Modal Delete --}}
                      <div class="modal fade" id="modalDelete{{ $l->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                              <h6 class="modal-title">Apakah anda yakin akan menghapus? </h6>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                               <div class="card ml-7" style="width: 18rem;">
                                  <img src="https://images.tokopedia.net/img/cache/500-square/product-1/2018/10/9/9364078/9364078_d0a8c5ec-5efe-490b-82f6-fac44d6d7b1d_1000_1000.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Kode Peminjaman : <h6 class="fw-bold">{{ $l->loans_code }}</h6><hr></h5>
                                            <h5 class="card-text mb-3">Peminjam : <h6 class="fw-bold">{{ $l->user->name }}</h6></h5><hr>
                                            <h5 class="card-text mb-3">Kelas Peminjam : <h6 class="fw-bold">{{ $l->user->userClass->class_name }}</h6></h5><hr>
                                            <h5 class="card-text mb-3">Barang : <h6 class="fw-bold">{{ $l->goods->name }}</h6></h5><hr>
                                            <h5 class="card-text mb-3">Tujuan : <h6 class="fw-bold">{{ $l->purpose }}</h6></h5>
                                          </div>
                                        </div>
                                      </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                      <form action="/peminjaman/hapus/{{ $l->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yakin!</button>
                                      </form>
                                </div>
                            </div>
                        </div>
                        </div>
                  {{-- End Modal Delete --}}

                </td>
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