@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-8">
            <h1 class="text-3xl font-bold">Detail Rambu Lalu Lintas</h1>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div>
                    @if($rambu->foto)
                        <img src="{{ asset('storage/'.$rambu->foto) }}" class="w-full rounded-xl shadow-lg">
                    @else
                        <div class="bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-xl w-full h-96 flex items-center justify-center text-gray-500 dark:text-gray-400 text-xl">
                            Tidak ada foto
                        </div>
                    @endif
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">Nama Rambu</label>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-200">{{ $rambu->nama_rambu }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">Jenis</label>
                        <span class="inline-block px-5 py-2 rounded-full text-white font-bold
                            {{ $rambu->jenis == 'Larangan' ? 'bg-red-600' : '' }}
                            {{ $rambu->jenis == 'Peringatan' ? 'bg-yellow-600' : '' }}
                            {{ $rambu->jenis == 'Petunjuk' ? 'bg-blue-600' : '' }}
                            {{ $rambu->jenis == 'Perintah' ? 'bg-green-600' : '' }}">
                            {{ $rambu->jenis }}
                        </span>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">Lokasi</label>
                        <p class="text-lg text-gray-900 dark:text-gray-200">{{ $rambu->lokasi }}</p>
                    </div>
                    @if($rambu->koordinat_gps)
                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">Koordinat GPS</label>
                        <p class="font-mono bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded text-gray-900 dark:text-gray-200">{{ $rambu->koordinat_gps }}</p>
                    </div>
                    @endif
                    <div>
                        <label class="text-sm text-gray-500 dark:text-gray-400">Kondisi</label>
                        <span class="inline-block px-5 py-2 rounded-full text-white font-bold
                            {{ $rambu->kondisi == 'Baik' ? 'bg-green-600' : '' }}
                            {{ $rambu->kondisi == 'Rusak' ? 'bg-red-600' : '' }}
                            {{ $rambu->kondisi == 'Perlu Perbaikan' ? 'bg-yellow-600' : '' }}">
                            {{ $rambu->kondisi }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t-4 border-dashed border-gray-300 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-calendar-plus text-3xl text-blue-600 dark:text-blue-400"></i>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dibuat pada</p>
                            <p class="font-black text-gray-900 dark:text-gray-100">
                                {{ $rambu->created_at->translatedFormat('d F Y') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                pukul {{ $rambu->created_at->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fas fa-user text-3xl text-green-600 dark:text-green-400"></i>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Oleh</p>
                            <p class="font-bold text-gray-900 dark:text-gray-100">
                                {{ $rambu->user?->name ?? 'Sistem' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex gap-4">
                <a href="{{ route('rambu.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">Kembali</a>
                <a href="{{ route('rambu.edit', $rambu) }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection