@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    <!-- Header Selamat Datang -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl shadow-xl p-8 mb-8">
        <h1 class="text-4xl font-bold mb-2">
            Halo, {{ Auth::user()->name }}!
        </h1>
        <p class="text-lg opacity-90">
            Selamat datang di Sistem Pendataan Rambu Lalu Lintas
            @if(Auth::user()->isAdmin())
                <span class="ml-3 bg-red-600 text-white px-4 py-1 rounded-full text-sm font-semibold">ADMIN</span>
            @endif
        </p>
    </div>

    <!-- Notifikasi Rambu Rusak / Perlu Perbaikan -->
    @if($rusak + $perlu > 0)
    <div class="bg-red-50 dark:bg-red-900/30 border-l-8 border-red-600 rounded-r-xl p-6 mb-8 shadow-lg flex items-center">
        <i class="fas fa-exclamation-triangle text-5xl text-red-600 mr-6"></i>
        <div>
            <h3 class="text-2xl font-bold text-red-800 dark:text-red-300">Peringatan!</h3>
            <p class="text-lg text-red-700 dark:text-red-200">
                Terdapat <strong>{{ $rusak + $perlu }} rambu</strong> yang <strong>RUSAK</strong> atau <strong>PERLU DIPERBAIKI</strong> segera.
            </p>
            <a href="{{ route('rambu.index') }}" class="mt-3 inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                Lihat Detail
            </a>
        </div>
    </div>
    @endif

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Rambu</p>
                    <p class="text-4xl font-bold text-gray-800 dark:text-gray-200 mt-2">{{ $total }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900/50 p-4 rounded-full">
                    <i class="fas fa-road text-3xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Kondisi Baik</p>
                    <p class="text-4xl font-bold text-green-600 mt-2">{{ $baik }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900/50 p-4 rounded-full">
                    <i class="fas fa-check-circle text-3xl text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Rusak / Perlu Perbaikan</p>
                    <p class="text-4xl font-bold text-red-600 mt-2">{{ $rusak + $perlu }}</p>
                </div>
                <div class="bg-red-100 dark:bg-red-900/50 p-4 rounded-full">
                    <i class="fas fa-tools text-3xl text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Terdata di Peta</p>
                    <p class="text-4xl font-bold text-purple-600 mt-2">{{ $gpsCount }}</p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900/50 p-4 rounded-full">
                    <i class="fas fa-map-marker-alt text-3xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart + Tabel Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Statistik Kondisi Rambu</h3>
            <canvas id="chartKondisi" class="w-full"></canvas>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Rambu Terbaru</h3>
                <a href="{{ route('rambu.index') }}" class="text-blue-600 hover:underline dark:text-blue-400 dark:hover:text-blue-300">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($terbaru as $r)
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                    <div class="flex items-center space-x-4">
                        @if($r->foto)
                            <img src="{{ asset('storage/'.$r->foto) }}" class="w-12 h-12 object-cover rounded-lg">
                        @else
                            <div class="bg-gray-300 dark:bg-gray-600 w-12 h-12 rounded-lg"></div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-200">{{ Str::limit($r->nama_rambu, 30) }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $r->lokasi }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        {{ $r->kondisi == 'Baik' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' : '' }}
                        {{ $r->kondisi == 'Rusak' ? 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300' : '' }}
                        {{ $r->kondisi == 'Perlu Perbaikan' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' : '' }}">
                        {{ $r->kondisi }}
                    </span>
                </div>
                @empty
                <p class="text-center text-gray-500 dark:text-gray-400 py-8">Belum ada data rambu</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('rambu.create') }}" class="bg-blue-600 text-white p-6 rounded-xl hover:bg-blue-700 transition transform hover:scale-105">
                <i class="fas fa-plus-circle text-3xl mb-2"></i>
                <p class="font-semibold">Tambah Rambu</p>
            </a>
            <a href="{{ route('rambu.peta') }}" class="bg-purple-600 text-white p-6 rounded-xl hover:bg-purple-700 transition transform hover:scale-105">
                <i class="fas fa-map text-3xl mb-2"></i>
                <p class="font-semibold">Lihat Peta</p>
            </a>
            <a href="{{ route('export.excel') }}" class="bg-green-600 text-white p-6 rounded-xl hover:bg-green-700 transition transform hover:scale-105">
                <i class="fas fa-file-excel text-3xl mb-2"></i>
                <p class="font-semibold">Export Excel</p>
            </a>
            <a href="{{ route('export.pdf') }}" class="bg-red-600 text-white p-6 rounded-xl hover:bg-red-700 transition transform hover:scale-105">
                <i class="fas fa-file-pdf text-3xl mb-2"></i>
                <p class="font-semibold">Export PDF</p>
            </a>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const isDark = document.documentElement.classList.contains('dark');
    new Chart(document.getElementById('chartKondisi'), {
        type: 'doughnut',
        data: {
            labels: ['Baik', 'Rusak', 'Perlu Perbaikan'],
            datasets: [{
                data: [{{ $baik }}, {{ $rusak }}, {{ $perlu }}],
                backgroundColor: ['#10B981', '#EF4444', '#F59E0B'],
                borderWidth: 2,
                borderColor: isDark ? '#1f2937' : '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { 
                    position: 'bottom', 
                    labels: { 
                        padding: 20,
                        color: isDark ? '#d1d5db' : '#374151'
                    } 
                }
            }
        }
    });
</script>
@endsection