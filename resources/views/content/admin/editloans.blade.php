@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-4">Silahkan ganti data dengan data yang baru</h6>
</div>
<form action="/peminjaman/edit/{{ $loans->id }}" method="POST">
    @method('put')
    @csrf
    <div class="container rounded bg-white ml-5 mt-5 mb-5 ml-5 col-11 border border-primary">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right text-me fw-bold">Catat Peminjaman</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels fw-bold">Kode Peminjaman</label><input type="text" name="loans_code" class="form-me form-control border border-primary @error('name') is-invalid @enderror" placeholder="" value="{{ $loans->loans_code }}" readonly required></div>
                    </div>
                    <div class="row mt-3">
                        <input type="hidden" id="userId" name="user_id">
                        <div class="col-md-12"><label class="labels fw-bold">Peminjam</label><input type="text" id="selectedName" name="name" class="form-me form-control border border-primary @error('name') is-invalid @enderror" placeholder="" value="{{ $loans->user->name }}" required readonly></div>
                        <div class="col-md-12"><label class="labels fw-bold">Kelas Peminjam</label><input type="text" id="selectedClassname" name="classname" class="form-me form-control border border-primary @error('classname') is-invalid @enderror" placeholder="" value="{{ $loans->user->userClass->class_name }}" required readonly></div>
                        <div class="col-md-3 mt-1 mb-3">
                            <button class="btn-sm btn-me text-light" type="button" data-bs-toggle="modal" data-bs-target="#modalPeminjam">Pilih</button>
                        </div>
                        </div>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-md-12"><label class="labels fw-bold">Barang Yang Dipinjam</label><select name="goods_id" class="form-me form-select border border-primary fw-light fs-6">
                            <option value="{{ $loans->goods->id }}">{{ $loans->goods->name }}</option>
                            @foreach ($goods as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels fw-bold">Tujuan Peminjaman</label><input type="text" name="purpose" class="form-me form-control border border-primary @error('purpose') is-invalid @enderror" placeholder="" value="{{ $loans->purpose }}" required>
                            @error('purpose')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-me text-light" type="submit"><span class="fas fa-pencil"></span> Edit</button>
                        <a href="/dashboard"><button class="btn btn-danger ml-3 text-light" type="button"><span class="fas fa-ban"></span> Batal</button></div></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </form>

    {{-- Modal Peminjam --}}
    <div class="modal fade" id="modalPeminjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Peminjam</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row">
            <div class="modal-body table-responsive">
                <table id="myTable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $u)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->userClass->class_name }}</td>
                        <td><button id="select"
                            data-id="{{ $u->id }}"
                            data-name="{{ $u->name }}"
                            data-classname="{{ $u->userClass->class_name }}"
                             class="btn btn-sm btn-success" data-bs-dismiss="modal"><span class="fa fa-check"></span> Pilih</button></td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Batal</button>
              </div>
          </div>
        </div>
      </div>

@endsection