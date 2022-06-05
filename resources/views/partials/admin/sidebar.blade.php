<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4">
            <h1><a href="index.html" class="logo">E - Inventaris <span>SMK MAHAPUTRA</span></a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard"><span class="fas fa-gauge-high mr-3"></span> Dashboard</a>
                </li>
                <li class="{{ Request::is('peminjaman/*') ? 'active' : ''}}">
                    <a href="#menuPeminjaman" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                            class="fas fa-edit mr-3"></span> Kelola Peminjaman</a>
                    <ul class="collapse list-unstyled" id="menuPeminjaman">
                        <li>
                            <a href="/peminjaman/lihat">Lihat Data Peminjaman</a>
                        </li>
                        <li>
                            <a href="/peminjaman/catat">Catat Peminjaman</a>
                        </li>
                        <li>
                            <a href="/peminjaman/edit">Edit Catatan Peminjaman</a>
                        </li>
                        <li>
                            <a href="/peminjaman/hapus">Hapus Catatan Peminjaman</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('barang/*') ? 'active' : '' }}">
                    <a href="#menuBarang" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                            class="fas fa-box mr-3"></span> Kelola Barang</a>
                    <ul class="collapse list-unstyled" id="menuBarang">
                        <li>
                            <a href="/barang/lihat">Lihat Semua Barang</a>
                        </li>
                        <li>
                            <a href="/barang/tambah">Tambah Barang</a>
                        </li>
                        <li>
                            <a href="/barang/edit">Edit Barang</a>
                        </li>
                        <li>
                            <a href="/barang/hapus">Hapus Barang</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('user/*') ? 'active' : '' }}">
                    <a href="#menuUser" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                            class="fas fa-users-gear mr-3"></span> Kelola User</a>
                    <ul class="collapse list-unstyled" id="menuUser">
                        <li>
                            <a href="/user/lihat">Lihat Semua User</a>
                        </li>
                        <li>
                            <a href="/user/tambah">Tambah User</a>
                        </li>
                        <li>
                            <a href="/user/edit">Edit User</a>
                        </li>
                        <li>
                            <a href="/user/hapus">Hapus User</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('pengaturan/*') ? 'active' : '' }}">
                    <a href="/pengaturanakun"><span class="fas fa-gears mr-3"></span> Pengaturan</a>
                </li>
                <li class="{{ Request::is('laporan/*') ? 'active' : '' }}">
                    <a href="/laporan"><span class="fas fa-file-circle-exclamation mr-3"></span> Laporan</a>
                </li>
                <li>
                    <button data-bs-toggle="modal" data-bs-target="#modalLogout"
                        class="btn btn-outline-light mt-2">Logout</button>
                </li>
                <!-- Modal Logout -->
                <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Perhatian!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
