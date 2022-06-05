<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-bars"></i>
      <span class="sr-only">Toggle Menu</span>
    </button>
</div>
        <div class="p-4">
          <h1><a href="/home" class="logo">E - Inventaris <span>SMK MAHAPUTRA</span></a></h1>
    <ul class="list-unstyled components mb-5">
      <li class="{{ $title == 'Beranda' ? 'active' : '' }}">
        <a href="/home"><span class="fas fa-house mr-3"></span> Beranda</a>
      </li>
      <li class="{{ $title == 'Lihat Semua Barang' ? 'active' : '' }}">
          <a href="/semuabarang"><span class="fas fa-box mr-3"></span> Lihat Semua Barang</a>
      </li>
      <li class="{{ $title == 'Cari Barang' ? 'active' : '' }}">
          <a href="/caribarang"><span class="fas fa-search mr-3"></span> Cari Barang</a>
      </li>
      <li class="{{ $title == 'Sejarah Peminjaman' ? 'active' : '' }}">
          <a href="/sejarahpeminjaman"><span class="fas fa-clock-rotate-left mr-3"></span>  Sejarah Peminjaman</a>
      </li>
      <li class="{{ $title == 'Pengaturan' ? 'active' : '' }}">
          <a href="/pengaturan"><span class="fas fa-gears mr-3"></span> Pengaturan</a>
      </li>
      <li>
        <button class="btn btn-outline-light mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#modalLogout">Logout</button>
      </li>
            <!-- Modal Logout -->
      <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Perhatian!</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h6 class="text-dark">Apakah anda yakin akan logout?</h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
              <a href="/logout"><button type="button" class="btn btn-me text-light">Yakin</button></a>
            </div>
          </div>
        </div>
      </div>
          {{-- End Modal Logout --}}
    </ul>      
  </div>
</nav>



