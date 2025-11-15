          {{-- SIDEBAR --}}
          <div class="bg-dark text-white p-3" style="width:260px; min-height:100vh;">

              {{-- Profile --}}
              <div class="text-center mb-4">
                  <img src="https://ui-avatars.com/api/?name={{ auth()->user()->nama_pegawai }}&background=0D8ABC&color=fff"
                      class="rounded-circle mb-2 d-block mx-auto"
                      width="70"
                      height="70">

                  <h6 class="mb-0">{{ auth()->user()->nama_pegawai }}</h6>
                  <small class="text-secondary">Administrasi Aset</small>
              </div>

              {{-- Menu --}}
              <ul class="nav flex-column">

                  <li class="nav-item mb-1">
                      <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu
                        {{ request()->is('dashboard') ? 'bg-secondary' : '' }}"
                          href="{{ route('dashboard') }}">
                          <i class="bi bi-speedometer2"></i> Dashboard
                      </a>
                  </li>

                  <li class="nav-item mb-1">
                      <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                          href="#">
                          <i class="bi bi-file-earmark-plus"></i> Usulan Pengadaan Aset
                      </a>
                  </li>

                  <li class="nav-item mb-1">
                      <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                          href="#">
                          <i class="bi bi-bag-plus"></i> Penambahan / Pengadaan Aset
                      </a>
                  </li>

                  <li class="nav-item mb-1">
                      <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                          href="#">
                          <i class="bi bi-box-seam"></i> Daftar Aset
                      </a>
                  </li>

                  <li class="nav-item mb-1">
                      <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                          href="#">
                          <i class="bi bi-hammer"></i> Pemeliharaan Aset
                      </a>
                  </li>

                  <li class="nav-item mb-1">
                      <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                          href="#">
                          <i class="bi bi-trash"></i> Rekomendasi Penghapusan
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                          href="#">
                          <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                      </a>
                  </li>

              </ul>

          </div>

          <style>
              .hover-menu:hover {
                  background-color: rgba(255, 255, 255, 0.1);
                  transition: 0.2s;
              }
          </style>