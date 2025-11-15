<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-2 shadow-sm">

    {{-- Tanggal & Waktu --}}
    <div class="navbar-text text-secondary fw-semibold" id="dateTime"></div>

    <ul class="navbar-nav ms-auto">

        {{-- Dropdown User --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->nama_pegawai }}&background=0D8ABC&color=fff"
                    width="35" height="35" class="rounded-circle me-2">
                <span
                class="mr-2">{{ auth()->user()->nama_pegawai }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

{{-- Script Tanggal + Waktu --}}
<script>
    function updateDateTime() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const time = now.toLocaleTimeString('id-ID');
        const date = now.toLocaleDateString('id-ID', options);

        document.getElementById('dateTime').innerHTML = `${date} | ${time}`;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
