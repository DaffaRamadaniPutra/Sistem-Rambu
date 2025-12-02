@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Log Aktivitas Sistem</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Semua aktivitas pengguna tercatat secara real-time</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" role="table">
                <thead class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Aksi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Detail Perubahan</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($activities as $act)
                        <tr class="hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition duration-200">
                            <!-- Waktu -->
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <div class="text-gray-900 dark:text-gray-100 font-semibold">
                                    {{ $act->created_at->format('d M Y') }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $act->created_at->format('H:i:s') }}
                                </div>
                            </td>

                            <!-- Pengguna -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                        {{ \Illuminate\Support\Str::upper(substr($act->causer?->name ?? 'SYS', 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800 dark:text-gray-100">
                                            {{ $act->causer?->name ?? 'System' }}
                                        </div>
                                        @if($act->causer && method_exists($act->causer, 'isAdmin') && $act->causer->isAdmin())
                                            <span class="inline-block bg-red-600 dark:bg-red-500 text-white text-xs px-3 py-1 rounded-full font-bold shadow">
                                                ADMIN
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Aksi — Update match untuk description custom dari Rambu -->
                            <td class="px-6 py-4">
                                @php
                                    $badge = match($act->description) {
                                        'Rambu telah created' => ['bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300', 'TAMBAH DATA', 'Data baru ditambahkan'],
                                        'Rambu telah updated' => ['bg-sky-100 dark:bg-sky-900/40 text-sky-800 dark:text-sky-300', 'EDIT DATA', 'Data diperbarui'],
                                        'Rambu telah deleted' => ['bg-rose-100 dark:bg-rose-900/40 text-rose-800 dark:text-rose-300', 'HAPUS DATA', 'Data dihapus sementara'],
                                        'Rambu telah restored' => ['bg-violet-100 dark:bg-violet-900/40 text-violet-800 dark:text-violet-300', 'PULIHKAN DATA', 'Data dipulihkan'],
                                        'Rambu telah forceDeleted' => ['bg-red-100 dark:bg-red-900/50 text-red-900 dark:text-red-300 font-bold', 'HAPUS PERMANEN', 'Data dihapus permanen'],
                                        'login' => ['bg-cyan-100 dark:bg-cyan-900/40 text-cyan-800 dark:text-cyan-300', 'LOGIN', 'Pengguna login'],
                                        'logout' => ['bg-orange-100 dark:bg-orange-900/40 text-orange-800 dark:text-orange-300', 'LOGOUT', 'Pengguna logout'],
                                        default => ['bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300', 'AKTIVITAS LAIN', 'Aktivitas lainnya']
                                    };
                                @endphp
                                <span class="inline-block px-4 py-2 rounded-full text-xs font-bold shadow-sm {{ $badge[0] }}" title="{{ $badge[2] }}">
                                    {{ $badge[1] }}
                                </span>
                            </td>

                            <!-- Detail Perubahan — Update untuk description custom -->
                            <td class="px-6 py-4 text-sm max-w-md">
                                @if($act->subject_type && str_contains($act->subject_type, 'Rambu'))
                                    @php
                                        $old = $act->properties['old'] ?? [];
                                        $attributes = $act->properties['attributes'] ?? [];
                                        $nama = $attributes['nama_rambu'] ?? $old['nama_rambu'] ?? 'Rambu tidak diketahui';
                                    @endphp

                                    <div class="font-medium text-gray-900 dark:text-gray-100">
                                        "{{ $nama }}"
                                    </div>

                                    @if(str_contains($act->description, 'created'))
                                        <span class="text-emerald-600 dark:text-emerald-400">Rambu baru berhasil ditambahkan</span>
                                    @elseif(str_contains($act->description, 'updated'))
                                        @php
                                            $changes = collect(array_diff_assoc($attributes, $old))->map(function ($newValue, $key) use ($old) {
                                                $oldValue = $old[$key] ?? 'Tidak ada';
                                                return ucfirst($key) . ': <del class="text-red-500 dark:text-red-400">' . $oldValue . '</del> → <ins class="font-bold text-green-600 dark:text-green-400">' . $newValue . '</ins>';
                                            });
                                        @endphp
                                        @if($changes->isNotEmpty())
                                            <span class="text-sky-600 dark:text-sky-400">
                                                Perubahan: {!! $changes->implode('<br>') !!}
                                            </span>
                                        @else
                                            <span class="text-sky-600 dark:text-sky-400">Data rambu diperbarui (tidak ada perubahan spesifik)</span>
                                        @endif
                                    @elseif(str_contains($act->description, 'deleted'))
                                        <span class="text-rose-600 dark:text-rose-400">Rambu dihapus sementara (soft delete)</span>
                                    @elseif(str_contains($act->description, 'restored'))
                                        <span class="text-violet-600 dark:text-violet-400">Rambu berhasil dipulihkan</span>
                                    @elseif(str_contains($act->description, 'forceDeleted'))
                                        <span class="text-red-600 dark:text-red-400 font-bold">Rambu dihapus secara permanen!</span>
                                    @endif

                                @elseif(in_array($act->description, ['login', 'logout']))
                                    <span class="text-cyan-600 dark:text-cyan-400">
                                        {{ $act->description === 'login' ? 'Berhasil masuk ke sistem' : 'Keluar dari sistem' }}
                                    </span>

                                @else
                                    <span class="text-gray-500 dark:text-gray-400 italic">
                                        {{ ucfirst($act->description ?? 'Aktivitas') }} pada {{ class_basename($act->subject_type ?? 'Sistem') }}
                                        @if($act->properties)
                                            - Detail: {{ json_encode($act->properties, JSON_PRETTY_PRINT) }}
                                        @endif
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-20">
                                <i class="fas fa-history text-7xl mb-6 text-gray-300 dark:text-gray-600 opacity-50"></i>
                                <p class="text-xl text-gray-500 dark:text-gray-400">Belum ada aktivitas tercatat</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 dark:bg-gray-900/70 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $activities->onEachSide(2)->links() }}
        </div>
    </div>
</div>
@endsection