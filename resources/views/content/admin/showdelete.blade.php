@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-3">{{ $title }}</h2>
    <h6 class="text-secondary ml-3 mb-5">Silahkan pilih barang yang akan dihapus!</h6>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<form action="/barang/hapus" method="GET" class="d-flex mt-2">
    <input class="form-control me-2 form-me fw-bold" name="search" type="search" placeholder="Cari Barang....." aria-label="Search">
    <button class="btn btn-me text-light" type="submit"><i class="fas fa-search"></i></button>
  </form>

  <div class="container-fluid mt-5 mb-3">
      <div class="row">
        @forelse ($goods as $g)
          <div class="col-10 col-md-6 col-sm-6 col-xs-12 col-lg-3">
            <div class="card ml-3 mt-3 border-me" style="width: 18rem;">
                <img src="{{ asset('storage/' . $g->image ) }}" class="card-img-top" width="325" height="325">
                <div class="card-body">
                  <h4 class="card-title">{{ $g->name }}</h4>
                  <h6 class="card-text mb-3">Stok Tersedia : {{ $g->stock }}</h6>
                    <button class="btn btn-danger text-light d-inline" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $g->id }}" type="submit"><span class="fas fa-ban"></span> Hapus</button>

                    {{-- Modal Delete --}}
                <div class="modal fade" id="modalDelete{{ $g->id }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title">Apakah anda yakin akan menghapus?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="card ml-7" style="width: 18rem;">
                          <img src="{{ asset('storage/' . $g->image) }}" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">{{ $g->name }}</h5>
                            <p class="card-text">Stock : {{ $g->stock }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <form action="/barang/hapus/{{ $g->id }}" method="POST">
                          @method('delete')
                          @csrf
                          <button type="submit" class="btn btn-danger">Yakin!</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                  {{-- End Modal Delete --}}
                </div>
              </div>
          </div>
          @empty
          <div class="card mt-3">
            <div class="card-body">
              <h5 class="text-secondary text-center">Belum ada data barang!</h5>
            </div>
          </div>
          @endforelse
      </div>
  </div>
@endsection