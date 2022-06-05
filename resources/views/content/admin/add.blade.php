@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-4">Silahkan isi semua data untuk menambah barang!</h6>
</div>
<form action="/barang/tambah" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container rounded bg-white ml-5 mt-5 mb-5 ml-5 col-11 border border-primary">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right text-me fw-bold">Tambah Barang</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Kode Barang</label><input type="text" name="productcode" class="form-me form-control border border-primary @error('productcode') is-invalid @enderror" placeholder="Masukkan kode barang" value="{{ 'BRG-'.$kd }}" readonly required></div>
                        <div class="col-md-12"><label class="labels fw-bold">Nama Barang</label><input type="text" name="name" class="form-me form-control border border-primary @error('name') is-invalid @enderror" placeholder="Masukkan nama barang" value="{{ old('name') }}" required autofocus>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Stok</label><input type="number" name="stock" class="form-me form-control border border-primary @error('stock') is-invalid @enderror" placeholder="Masukkan jumlah stok" value="{{ old('stock') }}" required>
                            @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror  
                        </div>
                        <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Merk</label><input type="text" name="brand" class="form-me form-control border border-primary @error('brand') is-invalid @enderror" placeholder="Masukkan nama merk" value="{{ old('brand') }}" required>
                            @error('brand')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-6 mt-3 mb-3"><label class="labels fw-bold">Gambar Barang</label>
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                            <input type="file" name="image" id="image" class="form-me form-control border border-primary @error('image') is-invalid @enderror" onchange="previewImage()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-me text-light" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
                        <a href="/barang/lihat"><button class="btn btn-danger ml-3 text-light" type="button"><span class="fas fa-ban"></span> Batal</button></a></div>
                    </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </form>
@endsection