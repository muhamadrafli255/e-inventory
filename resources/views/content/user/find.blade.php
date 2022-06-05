@extends('layouts.user.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12 mt-3">
            <h2 class="text-me ml-5">{{ $title }}</h2>
            <h6 class="text-secondary ml-5 mb-5">Hallo {{ auth()->user()->name }}, Mau Pinjam Apa Nih?</h6>
        </div>
        <form action="/caribarang" method="GET" class="d-flex mt-2">
            <input class="form-control me-2 form-me fw-bold" name="search" type="search" id="search" placeholder="Cari Barang....."
                aria-label="Search">
            <button class="btn btn-me text-light" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <table id="read" class="table table-bordered float-center mt-3 mr-2 ml-3 mx-auto text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok Tersedia</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($totalgoods as $goods)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $goods->name }}</td>
                    <td>{{ $goods->stock }}</td>
                    <td><button class="btn btn-success text-light mt-2" data-bs-toggle="modal"
                            data-bs-target="#modaldetail{{ $goods->id }}"><span class="fas fa-eye"></span>
                            Detail
                        </button>
                        <button class="btn btn-me text-light mt-2" data-bs-toggle="modal"
                            data-bs-target="#modalpinjam{{ $goods->id }}"><span class="fas fa-dolly"></span>
                            Pinjam
                        </button>

                        {{-- Modal Detail --}}

                        <div class="modal fade" id="modaldetail{{ $goods->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Detail Barang</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card ml-7" style="width: 18rem;">
                                            <img src="{{ asset('storage/' . $goods->image) }}" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">Nama Barang : <h6 class="fw-bold">
                                                        {{ $goods->name }}</h6>
                                                    <hr>
                                                </h5>
                                                <h5 class="card-text mb-3">Merk : <h6 class="fw-bold">
                                                        {{ $goods->brand }}</h6>
                                                </h5>
                                                <hr>
                                                <h5 class="card-text mb-3">Stok : <h6 class="fw-bold">
                                                        {{ $goods->stock }}</h6>
                                                </h5>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- End Modal Detail --}}

                        {{-- Modal Pinjam --}}

                        <div class="modal fade" id="modalpinjam{{ $goods->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Yakin akan meminjam barang ini?</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card ml-7" style="width: 18rem;">
                                            <img src="{{ asset('storage/' . $goods->image) }}" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">Nama Barang : <h6 class="fw-bold">
                                                        {{ $goods->name }}</h6>
                                                    <hr>
                                                </h5>
                                                <h5 class="card-text mb-3">Merk : <h6 class="fw-bold">
                                                        {{ $goods->brand }}</h6>
                                                </h5>
                                                <hr>
                                                <h5 class="card-text mb-3">Stok : <h6 class="fw-bold">
                                                        {{ $goods->stock }}</h6>
                                                </h5>
                                                <hr>
                                            </div>
                                        </div>
                                        <form action="/userpinjam/{{ $goods->id }}" method="POST">
                                            @csrf
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label class="labels fw-bold float-left">Tujuan Peminjaman :
                                                    </label>
                                                    <input type="text" name="purpose"
                                                        class="form-me form-control border border-primary @error('purpose') is-invalid @enderror"
                                                        placeholder="" value="{{ old('purpose') }}" required>
                                                    <input type="hidden" name="loans_code"
                                                        class="form-me form-control border border-primary"
                                                        value="{{ 'PJM-'.$kd }}">
                                                    @error('purpose')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success"
                                            data-bs-dismiss="modal">Yakin!</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- End Modal Pinjam --}}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
