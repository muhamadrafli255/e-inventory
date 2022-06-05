@extends('layouts.user.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-3">{{ $title }}</h2>
    <h6 class="text-secondary ml-3 mb-5">Lagi Mau Pinjam Apa Nih?</h6>
</div>
<form class="d-flex mt-2">
    <input class="form-control me-2 form-me fw-bold" id="search" type="search" placeholder="Cari Barang....." aria-label="Search">
    <button class="btn btn-me text-light" type="submit"><i class="fas fa-search"></i></button>
  </form>
  <div class="container-fluid mt-5 mb-3">
    <div class="row" id="read">
        @foreach ($goods as $g)
          <div class="col-10 col-md-6 col-sm-6 col-xs-12 col-lg-3">
            <div class="card ml-3 mt-3 border-me" style="width: 18rem;">
                <img src="{{ asset('storage/' . $g->image) }}" class="card-img-top" width="325" height="325">
                <div class="card-body">
                  <h4 class="card-title">{{ $g->name }}</h4>
                  <h6 class="card-text">Stok Tersedia : {{ $g->stock }}</h6>
                  <button class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#modaldetail{{ $g->id }}"><span class="fas fa-eye"></span> Detail</button>
                  <button data-bs-toggle="modal" data-bs-target="#modalpinjam{{ $g->id }}" class="btn btn-me text-light"><span class="fas fa-dolly"></span> Pinjam</button>
                </div>
              </div>
          </div>
          {{-- Modal Detail --}}

          <div class="modal fade text-center text-dark" id="modaldetail{{ $g->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Detail Barang</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card ml-7" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $g->image) }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Nama Barang : <h6 class="fw-bold">
                                        {{ $g->name }}</h6>
                                    <hr>
                                </h5>
                                <h5 class="card-text mb-3">Merk : <h6 class="fw-bold">
                                        {{ $g->brand }}</h6>
                                </h5>
                                <hr>
                                <h5 class="card-text mb-3">Stok : <h6 class="fw-bold">
                                        {{ $g->stock }}</h6>
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

        <div class="modal fade text-center text-dark" id="modalpinjam{{ $g->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Yakin akan meminjam barang ini?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card ml-7" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $g->image) }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Nama Barang : <h6 class="fw-bold">
                                        {{ $g->name }}</h6>
                                    <hr>
                                </h5>
                                <h5 class="card-text mb-3">Merk : <h6 class="fw-bold">
                                        {{ $g->brand }}</h6>
                                </h5>
                                <hr>
                                <h5 class="card-text mb-3">Stok : <h6 class="fw-bold">
                                        {{ $g->stock }}</h6>
                                </h5>
                                <hr>
                            </div>
                        </div>
                        <form action="/userpinjam/{{ $g->id }}" method="POST">
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
          @endforeach
      </div>
  </div>
@endsection