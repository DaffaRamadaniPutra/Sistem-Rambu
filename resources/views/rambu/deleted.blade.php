@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-red-700 dark:text-red-400">Data Rambu yang Terhapus</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Hanya Admin yang bisa memulihkan atau menghapus permanen data ini.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-red-50 dark:bg-red-900/20">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nama Rambu</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Dihapus Pada</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($deletedRambus as $rambu)
                        <tr class="hover:bg-red-50 dark:hover:bg-red-900/10 transition">
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                @if($rambu->foto)
                                    <img src="{{ asset('storage/'.$rambu->foto) }}"
                                         class="w-16 h-16 object-cover rounded-lg border border-gray-300 dark:border-gray-600 opacity-70">
                                @else
                                    <div class="bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-lg w-16 h-16 flex items-center justify-center">
                                        <span class="text-xs text-gray-400">No foto</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-200">
                                {{ $rambu->nama_rambu }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ Str::limit($rambu->lokasi, 50) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-500">
                                {{ $rambu->deleted_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm space-x-4">
                                <!-- PULIHKAN -->
                                <form action="{{ route('rambu.restore', $rambu->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirmRestore(this, '{{ addslashes($rambu->nama_rambu) }}')">
                                    @csrf
                                    <button type="submit"
                                            class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-bold transition">
                                        Pulihkan
                                    </button>
                                </form>

                                <!-- HAPUS PERMANEN (menggunakan fungsi global dari layout) -->
                                <button type="button"
                                        onclick="confirmDelete('{{ route('rambu.forceDelete', $rambu->id) }}', '{{ addslashes($rambu->nama_rambu) }}')"
                                        class="text-red-700 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-bold transition">
                                    Hapus Permanen
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16 text-gray-500 dark:text-gray-400 text-lg">
                                Tidak ada data yang terhapus
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $deletedRambus->links() }}
        </div>
    </div>
</div>
@endsection