@extends('layouts.user.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12 mt-3">
            <h2 class="text-me ml-5">{{ $title }}</h2>
            <h6 class="text-secondary ml-5 mb-4">Hallo {{ auth()->user()->name }}, Lihat sejarah peminjamanmu disini!
            </h6>
        </div>
        <form class="d-flex mt-2">
            <input class="form-control me-2 form-me fw-bold" type="search" placeholder="Cari Data Peminjaman....."
                aria-label="Search">
            <button class="btn btn-me text-light" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <table class="table table-bordered float-center mt-3 mr-2 ml-3 mx-auto text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Dipinjam Pada</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $loan->Goods->name }}</td>
                    <td>{{ $loan->statusLoans->name }}</td>
                    <td>{{ $loan->created_at }}</td>
                    <td><button class="btn btn-success text-light" data-bs-toggle="modal"
                            data-bs-target="#modaldetail{{ $loan->id }}"><span class="fas fa-eye"></span>
                            Detail
                        </button>

                        {{-- Modal Detail --}}

                        <div class="modal fade" id="modaldetail{{ $loan->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Detail Peminjaman</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card ml-7" style="width: 18rem;">
                                            <img src="{{ asset('storage/' . $loan->Goods->image) }}" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">Nama Peminjam : <h6 class="fw-bold">
                                                        {{ auth()->user()->name }}</h6>
                                                    <hr>
                                                </h5>
                                                <h5 class="card-title">Nama Barang : <h6 class="fw-bold">
                                                        {{ $loan->Goods->name }}</h6>
                                                    <hr>
                                                </h5>
                                                <h5 class="card-text mb-3">Status : <h6 class="fw-bold">
                                                        {{ $loan->statusLoans->name }}</h6>
                                                </h5>
                                                <hr>
                                                <h5 class="card-text mb-3">Tujuan : <h6 class="fw-bold">
                                                        {{ $loan->purpose }}</h6>
                                                </h5>
                                                <hr>
                                                <h5 class="card-text mb-3">Tanggal Peminjaman : <h6 class="fw-bold">
                                                        {{ $loan->created_at }}</h6>
                                                </h5>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- End Modal Detail --}}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
