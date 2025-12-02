@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Data Rambu Lalu Lintas</h1>
        <a href="{{ route('rambu.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 flex items-center gap-2">
            Add Rambu
        </a>
    </div>
    
    <!-- SEARCH + FILTER BAR -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8" x-data="{ open: false }">
        <div class="flex flex-wrap gap-4 items-end">
            <!-- Search -->
            <div class="flex-1 min-w-64">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">Cari Rambu / Lokasi</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Ketik nama rambu atau jalan..."
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500"
                       x-on:input.debounce.500ms="const val = $event.target.value; const params = new URLSearchParams(window.location.search); val ? params.set('search', val) : params.delete('search'); window.location = window.location.pathname + (params.toString() ? '?' + params : '')">
            </div>
    
            <!-- Filter Jenis -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">Jenis Rambu</label>
                <select onchange="window.location = updateQueryString('jenis', this.value)" 
                        class="px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Jenis</option>
                    <option value="Larangan" {{ request('jenis') == 'Larangan' ? 'selected' : '' }}>Larangan</option>
                    <option value="Peringatan" {{ request('jenis') == 'Peringatan' ? 'selected' : '' }}>Peringatan</option>
                    <option value="Petunjuk" {{ request('jenis') == 'Petunjuk' ? 'selected' : '' }}>Petunjuk</option>
                    <option value="Perintah" {{ request('jenis') == 'Perintah' ? 'selected' : '' }}>Perintah</option>
                </select>
            </div>
    
            <!-- Filter Kondisi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">Kondisi</label>
                <select onchange="window.location = updateQueryString('kondisi', this.value)"
                        class="px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kondisi</option>
                    <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Perlu Perbaikan" {{ request('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                </select>
            </div>
    
            <!-- Filter User (hanya admin) -->
            @if(auth()->user()->isAdmin())
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">Petugas</label>
                <select onchange="window.location = updateQueryString('user_id', this.value)"
                        class="px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Petugas</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
    
            <!-- Reset Filter -->
            <div>
                <a href="{{ route('rambu.index') }}" 
                   class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Reset
                </a>
            </div>
        </div>
    </div>
    
    <!-- JS Helper untuk update URL -->
    <script>
    function updateQueryString(key, value) {
        const params = new URLSearchParams(window.location.search);
        if (value === '' || value === 'semua') {
            params.delete(key);
        } else {
            params.set(key, value);
        }
        return window.location.pathname + (params.toString() ? '?' + params.toString() : '');
    }
    </script>

    <!-- TABEL DATA RAMBU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Foto</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nama Rambu</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Jenis</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Kondisi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($rambus as $rambu)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $loop->iteration + ($rambus->currentPage() - 1) * $rambus->perPage() }}</td>
                        <td class="px-6 py-4">
                            @if($rambu->foto)
                                <img src="{{ asset('storage/'.$rambu->foto) }}" class="w-16 h-16 object-cover rounded-lg shadow">
                            @else
                                <div class="bg-gray-200 dark:bg-gray-600 border-2 border-dashed border-gray-300 dark:border-gray-500 rounded-lg w-16 h-16"></div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $rambu->nama_rambu }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $rambu->jenis == 'Larangan' ? 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300' : '' }}
                                {{ $rambu->jenis == 'Peringatan' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' : '' }}
                                {{ $rambu->jenis == 'Petunjuk' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300' : '' }}
                                {{ $rambu->jenis == 'Perintah' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' : '' }}">
                                {{ $rambu->jenis }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ Str::limit($rambu->lokasi, 35) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $rambu->kondisi == 'Baik' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' : '' }}
                                {{ $rambu->kondisi == 'Rusak' ? 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300' : '' }}
                                {{ $rambu->kondisi == 'Perlu Perbaikan' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' : '' }}">
                                {{ $rambu->kondisi }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-3">
                            <a href="{{ route('rambu.show', $rambu) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Lihat</a>
                            <a href="{{ route('rambu.edit', $rambu) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                            
                            <!-- TOMBOL HAPUS DENGAN SWEETALERT2 -->
                            <button onclick="confirmDelete('{{ route('rambu.destroy', $rambu) }}', '{{ addslashes($rambu->nama_rambu) }}')" 
                                    class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-bold">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12 text-gray-500 dark:text-gray-400 text-lg">
                            Belum ada data rambu
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4">
            {{ $rambus->onEachSide(2)->links() }}
        </div>
    </div>
</div>
@endsection