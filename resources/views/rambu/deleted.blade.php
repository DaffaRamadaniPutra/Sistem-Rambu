@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-4xl font-black text-red-600 dark:text-red-400">Data Rambu Terhapus</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Hanya Administrator yang dapat memulihkan atau menghapus permanen.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border-2 border-red-200 dark:border-red-900">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-red-700 to-red-900 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Foto</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Nama Rambu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Dihapus Pada</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($deletedRambus as $rambu)
                    <tr class="hover:bg-red-50 dark:hover:bg-red-900/20 transition opacity-90">
                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            @if($rambu->foto)
                                <img src="{{ asset('storage/'.$rambu->foto) }}" class="w-16 h-16 object-cover rounded-lg opacity-70">
                            @else
                                <div class="w-16 h-16 bg-gray-300 dark:bg-gray-700 rounded-lg border-2 border-dashed"></div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-700 dark:text-gray-300">{{ $rambu->nama_rambu }}</td>
                        <td class="px-6 py-4 text-sm">{{ Str::limit($rambu->lokasi, 50) }}</td>
                        <td class="px-6 py-4 text-xs text-red-600 dark:text-red-400">
                            {{ $rambu->deleted_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-center space-x-3">
                            <form action="{{ route('rambu.restore', $rambu->id) }}" method="POST" class="inline"onsubmit="return confirmRestore(this, '{{ addslashes($rambu->nama_rambu) }}')">
                                @csrf 
                                <button type="submit"
                                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold text-sm transition shadow-lg">
                                    <i class="fas fa-undo"></i> Pulihkan
                                </button>
                            </form>

                            <button onclick="confirmDeletePermanent('{{ route('rambu.forceDelete', $rambu->id) }}', '{{ addslashes($rambu->nama_rambu) }}')"
                                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-800 text-white px-6 py-3 rounded-lg font-bold text-sm transition shadow-lg">
                                <i class="fas fa-trash-alt"></i> Hapus Permanen
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-20 text-gray-500 text-2xl">
                            Tidak ada data terhapus
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-red-50 dark:bg-red-900/20 px-6 py-4 border-t-2 border-red-200">
            {{ $deletedRambus->links() }}
        </div>
    </div>
</div>
@endsection