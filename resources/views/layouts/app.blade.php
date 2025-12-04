<!DOCTYPE html>
<html lang="id" class="h-full" :class="{ 'dark': $store.darkMode.enabled }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Rambu Lalu Lintas - Dishub Cirebon')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        accent: '#f59e0b'
                    }
                }
            }
        }
    </script>
</head>

<body x-data="app" class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-950 dark:from-gray-900 dark:via-gray-800 dark:to-black text-white shadow-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-5">
                    <button @click="$store.sidebar.mobileOpen = !$store.sidebar.mobileOpen" class="lg:hidden text-2xl hover:text-yellow-300">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white rounded-full shadow-xl border-4 border-yellow-400 overflow-hidden ring-4 ring-white/30">
                            <img src="{{ asset('images/logo_dishub.png') }}" alt="Dishub" class="w-full h-full object-contain p-2">
                        </div>
                        <div class="leading-tight">
                            <h1 class="text-2xl font-black tracking-wider">DINAS PERHUBUNGAN</h1>
                            <p class="text-xs font-bold text-yellow-300 tracking-widest -mt-1">KOTA CIREBON</p>
                            <p class="text-[10px] opacity-90">Sistem Informasi Rambu Lalu Lintas</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <div class="hidden md:block text-right">
                        <p class="text-sm text-yellow-200">Selamat Datang</p>
                        <p class="font-bold text-lg">{{ Auth::user()->name }}</p>
                        @if(Auth::user()->isAdmin())
                            <span class="bg-red-600 px-3 py-1 rounded-full text-xs font-bold">ADMIN</span>
                        @endif
                    </div>
                    <button @click="$store.darkMode.toggle()" class="p-3 bg-white/20 hover:bg-white/30 rounded-full backdrop-blur-sm transition hover:scale-110">
                        <i class="fas fa-sun block dark:hidden text-yellow-400"></i>
                        <i class="fas fa-moon hidden dark:block text-yellow-300"></i>
                    </button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-600 hover:bg-red-700 px-5 py-2.5 rounded-lg font-bold flex items-center gap-2 transition">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN LAYOUT -->
    <div class="flex flex-1 overflow-hidden">
        <!-- SIDEBAR -->
        <aside x-data
               x-show="$store.sidebar.mobileOpen || window.innerWidth >= 1024"
               @click.away="$store.sidebar.mobileOpen = false"
               :class="{
                   'w-80': !$store.sidebar.collapsed,
                   'w-24': $store.sidebar.collapsed,
                   'translate-x-0': $store.sidebar.mobileOpen || window.innerWidth >= 1024,
                   '-translate-x-full': !$store.sidebar.mobileOpen && window.innerWidth < 1024
               }"
               class="fixed lg:static inset-y-0 left-0 z-40 bg-gradient-to-b from-blue-950 to-black dark:from-gray-900 dark:to-black text-white shadow-2xl transition-all duration-500 flex flex-col">

            <!-- Sidebar Header -->
            <div class="p-6 border-b-4 border-yellow-500 relative">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-yellow-400 rounded-full flex items-center justify-center shadow-xl">
                        <i class="fas fa-shield-alt text-blue-900 text-2xl"></i>
                    </div>
                    <div x-show="!$store.sidebar.collapsed">
                        <h2 class="text-xl font-black">MENU UTAMA</h2>
                        <p class="text-xs opacity-80">Dishub Kota Cirebon</p>
                    </div>
                </div>
                <button @click="$store.sidebar.toggle()" class="hidden lg:block absolute -right-4 top-10 bg-yellow-500 hover:bg-yellow-400 text-blue-900 p-2.5 rounded-full shadow-2xl">
                    <i x-show="!$store.sidebar.collapsed" class="fas fa-chevron-left"></i>
                    <i x-show="$store.sidebar.collapsed" class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Menu Items -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Menu Utama -->
                @foreach([
                    ['route' => 'dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard'],
                    ['route' => 'rambu.index', 'icon' => 'fa-road', 'label' => 'Data Rambu'],
                    ['route' => 'rambu.create', 'icon' => 'fa-plus-circle', 'label' => 'Tambah Rambu'],
                    ['route' => 'rambu.peta', 'icon' => 'fa-map-marked-alt', 'label' => 'Peta Rambu'],
                ] as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-4 py-4 px-5 rounded-xl transition-all duration-300
                              {{ request()->routeIs($item['route'].'*') ? 'bg-yellow-500 text-blue-900 shadow-xl shadow-yellow-500/30' : 'hover:bg-white/10' }}
                              group transform hover:scale-105">
                        <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center group-hover:bg-white/30">
                            <i class="fas {{ $item['icon'] }} text-lg"></i>
                        </div>
                        <span x-show="!$store.sidebar.collapsed" class="font-semibold">{{ $item['label'] }}</span>
                    </a>
                @endforeach

                @if(Auth::user()->isAdmin())
                    <div class="my-4 border-t-2 border-yellow-600 opacity-50"></div>
                    <p x-show="!$store.sidebar.collapsed" class="text-yellow-400 text-xs font-bold uppercase px-5 mb-2">Administrator</p>
                    @foreach([
                        ['route' => 'users.index', 'icon' => 'fa-users-cog', 'label' => 'Kelola Pengguna'],
                        ['route' => 'rambu.deleted', 'icon' => 'fa-trash-restore', 'label' => 'Data Terhapus'],
                        ['route' => 'logs.index', 'icon' => 'fa-history', 'label' => 'Log Aktivitas'],
                        ['route' => 'laporan.pdf', 'icon' => 'fa-file-pdf', 'label' => 'Export PDF'],
                        ['route' => 'laporan.excel', 'icon' => 'fa-file-excel', 'label' => 'Export Excel'],
                    ] as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-4 py-4 px-5 rounded-xl transition-all duration-300
                                  {{ request()->routeIs($item['route'].'*') ? 'bg-red-600 text-white shadow-xl' : 'hover:bg-red-900/50' }}
                                  group transform hover:scale-105">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center group-hover:bg-white/30">
                                <i class="fas {{ $item['icon'] }} text-lg"></i>
                            </div>
                            <span x-show="!$store.sidebar.collapsed" class="font-semibold">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                @endif
            </nav>

            <!-- User Info -->
            <div x-show="!$store.sidebar.collapsed" class="p-5 bg-black/30 border-t border-yellow-600">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-blue-900 font-bold"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-xs opacity-80">{{ Auth::user()->isAdmin() ? 'Administrator' : 'Petugas' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay Mobile -->
        <div x-show="$store.sidebar.mobileOpen && window.innerWidth < 1024"
             @click="$store.sidebar.mobileOpen = false"
             class="fixed inset-0 bg-black/60 z-30 lg:hidden"></div>

        <!-- CONTENT -->
        <div class="flex-1 flex flex-col">
            <main class="flex-1 overflow-y-auto p-6 lg:p-10">
                @yield('content')
            </main>

            <!-- FOOTER -->
            <footer class="mt-auto bg-blue-950 dark:bg-black text-white border-t-4 border-yellow-400">
                <div class="max-w-7xl mx-auto px-6 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('images/logo_dishub.png') }}" alt="Dishub" class="w-16 h-16 rounded-full border-4 border-yellow-400">
                            <div>
                                <h3 class="font-black text-lg">DISHUB KOTA CIREBON</h3>
                                <p class="text-xs opacity-80">Sistem Informasi Rambu Lalu Lintas</p>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p><i class="fas fa-map-marker-alt text-yellow-400"></i> Jl. Terusan Pemuda No.8, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132</p>
                            <p><i class="fas fa-phone text-yellow-400"></i> (0231) 208445</p>
                            <p><i class="fas fa-envelope text-yellow-400"></i> dishub@cirebonkota.go.id</p>
                        </div>
                        <div class="text-right">
                            <p>© {{ date('Y') }} Dinas Perhubungan Kota Cirebon</p>
                            <p class="text-xs opacity-70">Dibuat dengan <i class="fas fa-heart text-red-500"></i> oleh {{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Alpine Store: Sidebar & Dark Mode
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                collapsed: localStorage.getItem('sidebarCollapsed') === 'true',
                mobileOpen: false,
                toggle() {
                    this.collapsed = !this.collapsed;
                    localStorage.setItem('sidebarCollapsed', this.collapsed);
                }
            });
    
            Alpine.store('darkMode', {
                enabled: localStorage.getItem('darkMode') === 'true' || 
                         (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                toggle() {
                    this.enabled = !this.enabled;
                    localStorage.setItem('darkMode', this.enabled);
                    document.documentElement.classList.toggle('dark', this.enabled);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('darkMode') === 'true' || 
                (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        });
    
        // === FUNGSI HAPUS KHUSUS DATA RAMBU (Soft Delete) ===
        function confirmDeleteRambu(url, nama = 'Data rambu ini') {
            Swal.fire({
                title: 'Yakin hapus?',
                text: nama + ' akan dipindahkan ke data terhapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = `
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    
        // === FUNGSI HAPUS PERMANEN (Data Terhapus) ===
        function confirmDeletePermanent(url, nama = 'Data ini') {
            Swal.fire({
                title: 'Yakin hapus permanen?',
                text: nama + ' akan dihapus SELAMANYA dan tidak bisa dikembalikan!',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = `
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                timer: 3000,
                timerProgressBar: true,
                background: '#10b981',
                color: '#fff'
            });
        @endif
    
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                toast: true,
                position: 'top-end',
                timer: 4000,
                timerProgressBar: true,
                background: '#ef4444',
                color: '#fff'
            });
        @endif
    </script>
</body>
</html>