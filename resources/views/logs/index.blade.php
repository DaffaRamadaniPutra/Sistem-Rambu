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
                                    {{ $act->created_at->translatedFormat('d F Y') }}
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
                                        'Rambu telah created'                     => ['bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300', 'TAMBAH DATA',      'Data baru ditambahkan'],
                                        'Rambu telah updated'                     => ['bg-sky-100 dark:bg-sky-900/40 text-sky-800 dark:text-sky-300',       'EDIT DATA',         'Data diperbarui'],
                                        'Rambu telah deleted'                     => ['bg-rose-100 dark:bg-rose-900/40 text-rose-800 dark:text-rose-300',     'HAPUS SEMENTARA',   'Data masuk tempat sampah'],
                                        'Rambu telah restored'                    => ['bg-violet-100 dark:bg-violet-900/40 text-violet-800 dark:text-violet-300','PULIHKAN',          'Data dipulihkan'],
                                        'Rambu dihapus PERMANEN dari sistem'      => ['bg-red-100 dark:bg-red-900/70 text-red-900 dark:text-red-200 font-bold border border-red-600 shadow-lg', 'HAPUS PERMANEN', 'Data dihapus selamanya'],
                                        'login'                                   => ['bg-cyan-100 dark:bg-cyan-900/40 text-cyan-800 dark:text-cyan-300',   'LOGIN',             'Pengguna masuk'],
                                        'logout'                                  => ['bg-orange-100 dark:bg-orange-900/40 text-orange-800 dark:text-orange-300','LOGOUT',            'Pengguna keluar'],
                                        default                                   => ['bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300',         'AKTIVITAS LAIN',    'Aktivitas lainnya']
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
                                        $nama = $act->subject?->nama_rambu 
                                            ?? $act->properties['nama_rambu'] 
                                            ?? $act->properties['attributes']['nama_rambu'] 
                                            ?? $act->properties['old']['nama_rambu'] 
                                            ?? 'Rambu tidak diketahui';
                                    @endphp
                            
                                    <div class="font-bold text-gray-900 dark:text-gray-100 text-lg mb-2">
                                        "{{ $nama }}"
                                    </div>
                            
                                    {{-- CREATE --}}
                                    @if(str_contains($act->description, 'created'))
                                        <span class="text-emerald-600 dark:text-emerald-400 font-medium">
                                            Rambu baru berhasil ditambahkan
                                        </span>
                            
                                    {{-- UPDATE --}}
                                    @elseif(str_contains($act->description, 'updated'))
                                        @php
                                            $old = $act->properties['old'] ?? [];
                                            $new = $act->properties['attributes'] ?? [];
                                            $changes = collect($new)->diffAssoc($old)->map(function ($value, $key) use ($old) {
                                                $oldVal = $old[$key] ?? '(kosong)';
                                                $label = ucwords(str_replace('_', ' ', $key));
                                                return "$label: <del class='text-red-600'>$oldVal</del> → <ins class='text-green-600 font-bold'>$value</ins>";
                                            });
                                        @endphp
                            
                                        @if($changes->isNotEmpty())
                                            <div class="text-sky-700 dark:text-sky-300 text-sm space-y-1 mt-2">
                                                <div class="font-semibold">Perubahan:</div>
                                                {!! $changes->implode('<br>') !!}
                                            </div>
                                        @else
                                            <span class="text-gray-500 italic">Tidak ada perubahan data</span>
                                        @endif
                            
                                    {{-- SOFT DELETE --}}
                                    @elseif($act->description === 'Rambu telah deleted')
                                        <div class="flex items-center gap-2 text-rose-600 dark:text-rose-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="font-medium">Dihapus sementara — bisa dipulihkan</span>
                                        </div>
                            
                                    {{-- RESTORE --}}
                                    @elseif($act->description === 'Rambu telah restored')
                                        <div class="flex items-center gap-2 text-violet-600 dark:text-violet-400 font-medium">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 110 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.447V3zm8 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                            </svg>
                                            Rambu berhasil dipulihkan
                                        </div>
                            
                                    {{-- FORCE DELETE / HAPUS PERMANEN --}}
                                    @elseif($act->description === 'Rambu dihapus PERMANEN dari sistem')
                                        <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="font-medium">DIHAPUS PERMANEN — TIDAK BISA DIPULIHKAN</span>
                                        </div>
                            
                                    @endif
                            
                                @elseif(in_array($act->description, ['login', 'logout']))
                                    <span class="text-cyan-600 dark:text-cyan-400 font-medium">
                                        {{ $act->description === 'login' ? 'Berhasil masuk ke sistem' : 'Keluar dari sistem' }}
                                    </span>
                            
                                @else
                                    <span class="text-gray-500 dark:text-gray-400 italic">
                                        {{ ucfirst($act->description ?? 'Aktivitas') }}
                                        @if($act->subject_type) pada {{ class_basename($act->subject_type) }} @endif
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