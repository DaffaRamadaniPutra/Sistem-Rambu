<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rambu Cirebon')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0"></script>

    <!-- Tailwind Config with dark mode -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#1d4ed8',
                            dark: '#3b82f6'
                        },
                        secondary: {
                            light: '#7c3aed',
                            dark: '#a855f7'
                        },
                        accent: '#f59e0b',
                        background: {
                            light: '#f3f4f6',
                            dark: '#1f2937'
                        }
                    },
                    boxShadow: {
                        'glow': '0 0 15px rgba(59, 130, 246, 0.5)',
                    },
                    transitionProperty: {
                        'width': 'width',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 min-h-screen flex flex-col transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="bg-primary-light dark:bg-background-dark text-white shadow-2xl z-40">
        <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
            <div class="flex items-center gap-4">
                <button @click="$store.sidebar.mobileOpen = !$store.sidebar.mobileOpen" class="lg:hidden text-2xl hover:text-accent transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-2xl font-bold tracking-wide">Rambu Lalu Lintas Cirebon</h1>
            </div>

            <div class="flex items-center gap-6">
                <span class="hidden sm:block font-medium">Halo, {{ Auth::user()->name }}</span>
                @if (Auth::user()->isAdmin())
                    <span class="bg-red-600 dark:bg-red-500 px-3 py-1 rounded-full text-sm font-bold uppercase tracking-wide">Admin</span>
                @endif

                <!-- Dark Mode Toggle -->
                <button id="dark-mode-toggle" class="p-2 bg-primary-light dark:bg-background-dark text-white rounded-full shadow-lg hover:shadow-glow transition-shadow">
                    <i class="fas fa-moon hidden dark:block"></i>
                    <i class="fas fa-sun block dark:hidden"></i>
                </button>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-accent transition-colors">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden relative">
        <!-- SIDEBAR -->
        <aside x-data x-show="$store.sidebar.mobileOpen || window.innerWidth >= 1024"
            @click.away="$store.sidebar.mobileOpen = false"
            :class="{
                'w-64': !$store.sidebar.collapsed,
                'w-20': $store.sidebar.collapsed,
                'fixed inset-y-0 left-0 z-40 lg:relative lg:translate-x-0': true,
                'translate-x-0': $store.sidebar.mobileOpen,
                '-translate-x-full': !$store.sidebar.mobileOpen && window.innerWidth < 1024
            }"
            class="bg-primary-dark dark:bg-gray-800 text-white flex flex-col transition-all duration-300 ease-in-out shadow-2xl">

            <!-- Tombol Collapse (Desktop) -->
            <button @click="$store.sidebar.toggle()"
                class="hidden lg:block absolute -right-3 top-20 bg-primary-light dark:bg-background-dark hover:bg-accent text-white p-2 rounded-full shadow-lg hover:shadow-glow z-50 transition-all">
                <i x-show="!$store.sidebar.collapsed" class="fas fa-chevron-left"></i>
                <i x-show="$store.sidebar.collapsed" class="fas fa-chevron-right"></i>
            </button>

            <!-- Header Sidebar -->
            <div class="p-6 border-b border-blue-700 dark:border-gray-700 text-center">
                <h2 class="font-bold text-xl tracking-wide" x-show="!$store.sidebar.collapsed">MENU</h2>
                <i class="fas fa-road text-3xl" x-show="$store.sidebar.collapsed"></i>
            </div>

            <!-- Navigasi -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->is('dashboard') ? 'bg-blue-700 dark:bg-gray-700 shadow-glow' : '' }}">
                    <i class="fas fa-tachometer-alt text-xl w-6 text-center"></i>
                    <span x-show="!$store.sidebar.collapsed" class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('rambu.index') }}"
                    class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->routeIs('rambu.index') ? 'bg-blue-700 dark:bg-gray-700 shadow-glow' : '' }}">
                    <i class="fas fa-road text-xl w-6 text-center"></i>
                    <span x-show="!$store.sidebar.collapsed" class="font-medium">Data Rambu</span>
                </a>

                <a href="{{ route('rambu.create') }}"
                    class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->routeIs('rambu.create') ? 'bg-blue-700 dark:bg-gray-700 shadow-glow' : '' }}">
                    <i class="fas fa-plus-circle text-xl w-6 text-center"></i>
                    <span x-show="!$store.sidebar.collapsed" class="font-medium">Tambah Rambu</span>
                </a>

                <a href="{{ route('rambu.peta') }}"
                    class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->routeIs('rambu.peta') ? 'bg-blue-700 dark:bg-gray-700 shadow-glow' : '' }}">
                    <i class="fas fa-map-marked-alt text-xl w-6 text-center"></i>
                    <span x-show="!$store.sidebar.collapsed" class="font-medium">Peta Rambu</span>
                </a>

                @if (Auth::user()->isAdmin())
                    <div class="border-t border-blue-700 dark:border-gray-700 my-4"></div>

                    <a href="{{ route('users.index') }}"
                        class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-blue-700 dark:bg-gray-700 shadow-glow' : '' }}">
                        <i class="fas fa-users-cog text-xl w-6 text-center"></i>
                        <span x-show="!$store.sidebar.collapsed" class="font-medium">Kelola Pengguna</span>
                    </a>

                    <a href="{{ route('rambu.deleted') }}"
                        class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-red-700 dark:hover:bg-red-600 transition-all duration-200 {{ request()->routeIs('rambu.deleted') ? 'bg-red-700 dark:bg-red-600 shadow-glow' : '' }}">
                        <i class="fas fa-trash-restore text-xl w-6 text-center"></i>
                        <span x-show="!$store.sidebar.collapsed" class="font-medium text-red-300 dark:text-red-200">Data Terhapus</span>
                    </a>

                    <a href="{{ route('logs.index') }}"
                        class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->routeIs('logs.*') ? 'bg-blue-700 dark:bg-gray-700 shadow-glow' : '' }}">
                        <i class="fas fa-history text-xl w-6 text-center"></i>
                        <span x-show="!$store.sidebar.collapsed" class="font-medium">Log Aktivitas</span>
                    </a>

                    <a href="{{ route('laporan.pdf') }}"
                        class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200">
                        <i class="fas fa-file-pdf text-xl w-6 text-center"></i>
                        <span x-show="!$store.sidebar.collapsed" class="font-medium">Export PDF</span>
                    </a>

                    <a href="{{ route('laporan.excel') }}"
                        class="flex items-center gap-4 py-3 px-4 rounded-xl hover:bg-blue-700 dark:hover:bg-gray-700 transition-all duration-200">
                        <i class="fas fa-file-excel text-xl w-6 text-center"></i>
                        <span x-show="!$store.sidebar.collapsed" class="font-medium">Export Excel</span>
                    </a>
                @endif
            </nav>
        </aside>

        <!-- Overlay Mobile -->
        <div x-show="$store.sidebar.mobileOpen && window.innerWidth < 1024" @click="$store.sidebar.mobileOpen = false"
            class="fixed inset-0 bg-black bg-opacity-60 z-30 lg:hidden transition-opacity duration-300"></div>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-6 lg:p-10 transition-colors duration-300">
            @yield('content')
        </main>
    </div>

    <!-- Alpine Store -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                collapsed: localStorage.getItem('sidebarCollapsed') === 'true',
                mobileOpen: false,

                toggle() {
                    this.collapsed = !this.collapsed;
                    localStorage.setItem('sidebarCollapsed', this.collapsed);
                }
            });
        });
    </script>

    <!-- Dark Mode Script -->
    <script>
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const html = document.documentElement;

        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        darkModeToggle.addEventListener('click', () => {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    </script>

    <!-- SweetAlert Flash Message -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ addslashes(session('success')) }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#10b981',
                    color: '#fff',
                    iconColor: '#fff'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ addslashes(session('error')) }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    background: '#ef4444',
                    color: '#fff',
                    iconColor: '#fff'
                });
            @endif
        });

        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        }

        // Confirm Delete
        function confirmDelete(url, nama) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: nama + " akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const token = document.createElement('input');
                    token.type = 'hidden';
                    token.name = '_token';
                    token.value = getCsrfToken();
                    form.appendChild(token);

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Confirm Restore
        function confirmRestore(form, nama) {
            Swal.fire({
                title: 'Pulihkan data?',
                text: nama + " akan dikembalikan",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Pulihkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
            return false;
        }
    </script>
</body>

</html>