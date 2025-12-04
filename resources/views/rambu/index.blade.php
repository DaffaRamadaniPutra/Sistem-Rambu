@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Data Rambu Lalu Lintas</h1>
        <a href="{{ route('rambu.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold flex items-center gap-2 transition shadow-lg">
            <i class="fas fa-plus-circle"></i> Tambah Rambu
        </a>
    </div>

    <!-- SEARCH + FILTER -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-gray-900 dark:to-black p-5 border-b border-blue-700 dark:border-gray-700">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-black text-white flex items-center gap-3">
                    <i class="fas fa-filter"></i> Filter & Pencarian Rambu Lalu Lintas
                </h3>
                <a href="{{ route('rambu.index') }}"
                   class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-800 hover:to-red-900 
                          text-white font-bold py-3 px-7 rounded-xl shadow-lg transform hover:scale-105 
                          transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                    <i class="fas fa-times-circle"></i>
                    Reset Filter
                </a>
            </div>
        </div>
    
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                <!-- SEARCH BOX -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-search text-blue-600 dark:text-blue-400"></i> Cari Rambu / Lokasi
                    </label>
                    <input type="text"
                           placeholder="Contoh: Stop, Jl. Siliwangi, Rambu Larangan..."
                           value="{{ request('search') }}"
                           class="w-full px-5 py-4 text-lg rounded-xl border-2 border-gray-300 dark:border-gray-600 
                                  bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white
                                  focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 
                                  transition-all duration-300 shadow-inner"
                           x-on:input.debounce.600ms="
                               const val = $event.target.value.trim();
                               const params = new URLSearchParams(window.location.search);
                               val ? params.set('search', val) : params.delete('search');
                               window.location = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
                           ">
                </div>
    
                <!-- JENIS RAMBU -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-sign text-red-600"></i> Jenis Rambu
                    </label>
                    <select onchange="updateFilter('jenis', this.value)"
                            class="w-full px-5 py-4 rounded-xl border-2 border-gray-300 dark:border-gray-600 
                                   bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white
                                   focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all">
                        <option value="">Semua Jenis</option>
                        @foreach(['Larangan','Peringatan','Petunjuk','Perintah'] as $j)
                            <option value="{{ $j }}" {{ request('jenis') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
    
                <!-- KONDISI RAMBU -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-tools text-orange-600"></i> Kondisi Rambu
                    </label>
                    <select onchange="updateFilter('kondisi', this.value)"
                            class="w-full px-5 py-4 rounded-xl border-2 border-gray-300 dark:border-gray-600 
                                   bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white
                                   focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all">
                        <option value="">Semua Kondisi</option>
                        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="Perlu Perbaikan" {{ request('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>
                            Perlu Perbaikan
                        </option>
                    </select>
                </div>
    
                <!-- PETUGAS (Hanya Admin) -->
                @if(auth()->user()->isAdmin())
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-user-hard-hat text-yellow-600"></i> Petugas Lapangan
                    </label>
                    <select onchange="updateFilter('user_id', this.value)"
                            class="w-full px-5 py-4 rounded-xl border-2 border-gray-300 dark:border-gray-600 
                                   bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white
                                   focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all">
                        <option value="">Semua Petugas</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Foto</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Nama Rambu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Jenis</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Kondisi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Dibuat</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($rambus as $rambu)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 text-center text-sm">
                            {{ $loop->iteration + ($rambus->currentPage() - 1) * $rambus->perPage() }}
                        </td>
                        <td class="px-6 py-4">
                            @if($rambu->foto)
                                <img src="{{ asset('storage/'.$rambu->foto) }}" class="w-16 h-16 object-cover rounded-lg shadow-lg">
                            @else
                                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-lg border-2 border-dashed flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold">{{ $rambu->nama_rambu }}</td>
                        <td class="px-6 py-4">
                            <span class="px-4 py-2 rounded-full text-xs font-bold text-white
                                {{ $rambu->jenis == 'Larangan' ? 'bg-red-600' : '' }}
                                {{ $rambu->jenis == 'Peringatan' ? 'bg-yellow-600' : '' }}
                                {{ $rambu->jenis == 'Petunjuk' ? 'bg-blue-600' : '' }}
                                {{ $rambu->jenis == 'Perintah' ? 'bg-green-600' : '' }}">
                                {{ $rambu->jenis }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ Str::limit($rambu->lokasi, 40) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-4 py-2 rounded-full text-xs font-bold text-white
                                {{ $rambu->kondisi == 'Baik' ? 'bg-green-600' : '' }}
                                {{ $rambu->kondisi == 'Rusak' ? 'bg-red-600' : '' }}
                                {{ $rambu->kondisi == 'Perlu Perbaikan' ? 'bg-orange-600' : '' }}">
                                {{ $rambu->kondisi }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-600 dark:text-gray-400">
                            {{ $rambu->created_at->format('d/m/Y') }}<br>
                            <span class="text-xs">{{ $rambu->created_at->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('rambu.show', $rambu) }}"
                               class="inline-flex items-center gap-2 bg-cyan-600 hover:bg-cyan-700 text-white px-5 py-2.5 rounded-lg font-bold text-sm transition shadow">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('rambu.edit', $rambu) }}"
                               class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white px-5 py-2.5 rounded-lg font-bold text-sm transition shadow">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button onclick="confirmDeleteRambu('{{ route('rambu.destroy', $rambu) }}', '{{ addslashes($rambu->nama_rambu) }}')"
                                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-bold text-sm transition shadow">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-16 text-gray-500 text-xl">
                            Belum ada data rambu
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 dark:bg-gray-900 px-6 py-4 border-t">
            {{ $rambus->onEachSide(2)->links() }}
        </div>
    </div>
</div>

<script>
function updateQueryString(key, value) {
    const params = new URLSearchParams(window.location.search);
    value ? params.set(key, value) : params.delete(key);
    window.location = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
}
</script>
<script>
function updateFilter(key, value) {
    const params = new URLSearchParams(window.location.search);
    value ? params.set(key, value) : params.delete(key);
    window.location = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
}
</script>
@endsection