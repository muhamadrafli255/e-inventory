@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-4">Silahkan ganti data dengan data yang baru!</h6>
</div>
<form action="/barang/edit/{{ $goods->id }}" method="POST">
    @method('put')
    @csrf
    <div class="container rounded bg-white ml-5 mt-5 mb-5 ml-5 col-11 border border-primary">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right text-me">Silahkan ganti data barang dengan data yang baru!</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels fw-bold">Nama Barang</label><input type="text" name="name" class="form-me form-control border border-primary" placeholder="Masukkan nama barang" value="{{ old('name', $goods->name) }}" required autofocus></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Stok</label><input type="number" name="stock" class="form-me form-control border border-primary" placeholder="Masukkan jumlah stok" value="{{ old('stock', $goods->stock) }}" required></div>
                        <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Merk</label><input type="text" name="brand" class="form-me form-control border border-primary" placeholder="Masukkan nama merk" value="{{ old('brand', $goods->brand) }}" required></div>
                        <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Kode Barang</label><input type="text" name="productcode" class="form-me form-control border border-primary" placeholder="Masukkan kode barang" value="{{  $goods->productcode }}" required readonly></div>
                        <div class="col-md-12 mt-3 mb-3"><label class="labels fw-bold">Gambar Barang</label>
                            @if ($goods->image)
                            
                            <img src="{{ asset('storage/' . $goods->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">

                            @else
                            
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                                
                            @endif
                            <input type="file" name="image" id="image" class="form-me form-control border border-primary @error('image') is-invalid @enderror" onchange="previewImage()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-me text-light" type="submit"><span class="fas fa-pencil"></span> Ubah</button>
                        <a href="/barang/edit"><button class="btn btn-danger ml-3 text-light" type="button"><span class="fas fa-ban"></span> Batal</button></a></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </form>
@endsection