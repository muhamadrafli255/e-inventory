@extends('layouts.admin.main')

@section('content')
<div id="content" class="container-fluid p-4 p-md-5 pt-5">
    <div class="row">
        <div class="col-12">
    <h2 class="text-me ml-5">{{ $title }}</h2>
    <h6 class="text-secondary ml-5 mb-5">Silahkan pilih data user yang akan dihapus!</h6>
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
                <td>
                    <button class="btn btn-danger text-light d-inline" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $user->id }}" type="submit"><span class="fas fa-ban"></span> Hapus</button>
                </td>
                 {{-- Modal Delete --}}
                 <div class="modal fade" id="modalDelete{{ $user->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                          <h6 class="modal-title text-dark">Apakah anda yakin akan menghapus? </h6>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                           <div class="card ml-7" style="width: 18rem;">
                            @if ($user->image == null)    
                            <img src="https://icon-library.com/images/user-icon-vector/user-icon-vector-26.jpg" class="card-img-top" alt="...">
                            @else
                            <img src="{{ asset('storage/' . $user->image) }}" class="card-img-top" alt="...">
                            @endif
                                <div class="card-body">
                                    <h5 class="card-title">Nama : <h6 class="fw-bold text-dark">{{ $user->name }}</h6><hr></h5>
                                        <h5 class="card-text mb-3">Email : <h6 class="fw-bold text-dark">{{ $user->email }}</h6></h5><hr>
                                        <h5 class="card-text mb-3">Kelas : <h6 class="fw-bold text-dark">{{ $user->userclass->class_name }}</h6></h5><hr>
                                      </div>
                                    </div>
                                  </div>
                                <div class="modal-footer">
                                    <form action="/user/hapus/{{ $user->id }}" method="POST">
                                      @method('delete')
                                      @csrf
                                      <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yakin!</button>
                                    </form>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                    </div>
              {{-- End Modal Delete --}}
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