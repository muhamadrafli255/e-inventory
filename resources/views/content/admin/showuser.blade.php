@extends('layouts.admin.main')

@section('content')

<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-me ml-5">{{ $title }}</h2>
            <h6 class="text-secondary ml-5 mb-5">Silahkan kelola data user disini!</h6>
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
                            <a href="/user/tambah"><button class="btn btn-me text-light mt-3 mb-3"><span
                                        class="fas fa-plus-circle"></span> Tambah Data</button></a>
                            <table id="myTable" class="table table-bordered">
                                <thead class="text-me">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->userclass->class_name }}</td>
                                        <td><button class="btn btn-success" type="submit" data-bs-toggle="modal"
                                                data-bs-target="#modalDetail{{ $user->id }}"><span
                                                    class="fas fa-eye"></span></button><br>
                                            <a href="/user/edit/{{ $user->id }}"
                                                class="btn btn-me mt-2 text-light"><span
                                                    class="fas fa-pencil"></span></a><br>
                                            <button class="btn btn-danger mt-2" type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $user->id }}"><span
                                                    class="fas fa-ban"></span></button>

                                            {{-- Modal Detail --}}
                                            <div class="modal fade" id="modalDetail{{ $user->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">Detail User</h6>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card ml-7" style="width: 18rem;">
                                                                @if ($user->image == null)
                                                                <img src="https://icon-library.com/images/user-icon-vector/user-icon-vector-26.jpg"
                                                                    class="card-img-top" alt="...">
                                                                @else
                                                                <img src="{{ asset('storage/' . $user->image) }}"
                                                                    class="card-img-top" alt="...">
                                                                @endif
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Nama : <h6 class="fw-bold">
                                                                            {{ $user->name }}</h6>
                                                                        <hr>
                                                                    </h5>
                                                                    <h5 class="card-text mb-3">Email : <h6
                                                                            class="fw-bold">{{ $user->email }}</h6>
                                                                    </h5>
                                                                    <hr>
                                                                    <h5 class="card-text mb-3">Kelas : <h6
                                                                            class="fw-bold"></h6>
                                                                        {{ $user->userclass->class_name }}</h5>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Modal Detail --}}

                                            {{-- Modal Delete --}}
                                            <div class="modal fade" id="modalDelete{{ $user->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">Apakah anda yakin akan menghapus?</h6>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card ml-7" style="width: 18rem;">
                                                                @if ($user->image == null)
                                                                <img src="https://icon-library.com/images/user-icon-vector/user-icon-vector-26.jpg"
                                                                    class="card-img-top" alt="...">
                                                                @else
                                                                <img src="{{ asset('storage/' . $user->image) }}"
                                                                    class="card-img-top" alt="...">
                                                                @endif
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Nama : <h6 class="fw-bold">
                                                                            {{ $user->name }}</h6>
                                                                        <hr>
                                                                    </h5>
                                                                    <h5 class="card-text mb-3">Email : <h6
                                                                            class="fw-bold">{{ $user->email }}</h6>
                                                                    </h5>
                                                                    <hr>
                                                                    <h5 class="card-text mb-3">Kelas : <h6
                                                                            class="fw-bold">
                                                                            {{ $user->userclass->class_name }}</h6>
                                                                    </h5>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">

                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalConfirm{{ $user->id }}" data-bs-dismiss="modal">Yakin!</button>
                                                                  
                                                                  <button type="button" class="btn btn-secondary"
                                                                  data-bs-dismiss="modal">Batal</button>
                                                                </div>
                                                    </div>
                                                </div>
                                              </div>
                                              {{-- End Modal Delete --}}
                                              
                                              {{-- Modal Confirm Delete --}}
                                              <div class="modal fade" tabindex="-1"
                                                  id="modalConfirm{{ $user->id }}">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title">Silahkan
                                                                  Konfirmasi</h5>
                                                              <button type="button" class="btn-close"
                                                                  data-bs-dismiss="modal"
                                                                  aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <p>Dengan Menghapus Akun Ini Semua Data
                                                                  Histori Peminjaman Akan Hilang,
                                                                  Silahkan Backup Terlebih Dahulu!</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <a href="/user/lihat"><button type="button"
                                                                  class="btn btn-secondary"
                                                                  data-bs-dismiss="modal" aria-label="close">Batal</button></a>
                                                                  <form action="/user/hapus/{{ $user->id }}" method="POST">
                                                                    @method('delete')
                                                                    @csrf
                                                              <button type="submit"
                                                                  class="btn btn-danger">Konfirmasi</button>
                                                                </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              {{-- End Modal Confirm Delete --}}

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
