@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-4">Selamat Datang {{ auth()->user()->name }}</h6>
</div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-lg-3">
            <div class="card ml-3 mt-3 border-me" style="width: 22rem;">
                <div class="card-body">
                  <h5 class="card-title text-center text-me fw-bold">Peminjaman</h5>
                  <h6 class="card-subtitle mb-3 text-muted text-center">Hari Ini</h6>
                  <h5 class="text-center fw-bold text-me">{{ $totalloans->count() }}</h5>
                  <h6 class="text-me text-center mt-3"><a href="/peminjaman/harian">Lihat Detail!</a></h6>
                </div>
              </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 col-lg-3">
            <div class="card ml-3 mt-3 border-me" style="width: 22rem;">
                <div class="card-body">
                  <h5 class="card-title text-center text-me fw-bold">Barang Tersedia</h5>
                  <h6 class="card-subtitle mb-3 text-muted text-center">Sekarang</h6>
                  <h5 class="text-center fw-bold text-me">{{ $totalgoods->count() }}</h5>
                  <h6 class="text-center text-me mt-3 "><a href="/barang/lihat">Lihat Detail!</a></h6>
                </div>
              </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 col-lg-3">
            <div class="card ml-3 mt-3 border-me" style="width: 22rem;">
            <div class="card-body">
                  <h5 class="card-title text-center text-me fw-bold">Sedang Dipinjam</h5>
                  <h6 class="card-subtitle mb-3 text-muted text-center">Hari Ini</h6>
                  <h5 class="text-center fw-bold text-me">{{ $loansday->count() }}</h5>
                  <h6 class="text-center text-me mt-3"><a href="/peminjaman/dipinjam">Lihat Detail!</a></h6>
            </div>
        </div>
    </div>
        <div class="col-md-6 col-sm-6 col-xs-12 col-lg-3">
            <div class="card ml-3 mt-3 border-me mb-5" style="width: 22rem;">
            <div class="card-body">
                  <h5 class="card-title text-center text-me fw-bold">Pengembalian</h5>
                  <h6 class="card-subtitle mb-3 text-center text-muted">Hari Ini</h6>
                  <h5 class="text-center text-me fw-bold">{{ $loansreturned->count() }}</h5>
                  <h6 class="text-center text-me mt-3"><a href="/peminjaman/dikembalikan">Lihat Detail!</a></h6>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
<div class="card mt-5">
    <div class="card-body">
        <h4 class="text-me ml-3 fw-bold">{{ $chart1->options['chart_title'] }}</h4>
        {!! $chart1->renderHtml() !!}
    </div>
  </div>
</div>
@endsection

@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection