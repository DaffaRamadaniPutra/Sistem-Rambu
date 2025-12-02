@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">Edit Rambu</h1>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
        <form action="{{ route('rambu.update', $rambu) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <!-- Sama seperti create, tapi value diisi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Nama Rambu</label>
                    <input type="text" name="nama_rambu" value="{{ old('nama_rambu', $rambu->nama_rambu) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Jenis Rambu</label>
                    <select name="jenis" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Larangan" {{ $rambu->jenis == 'Larangan' ? 'selected' : '' }}>Larangan</option>
                        <option value="Peringatan" {{ $rambu->jenis == 'Peringatan' ? 'selected' : '' }}>Peringatan</option>
                        <option value="Petunjuk" {{ $rambu->jenis == 'Petunjuk' ? 'selected' : '' }}>Petunjuk</option>
                        <option value="Perintah" {{ $rambu->jenis == 'Perintah' ? 'selected' : '' }}>Perintah</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $rambu->lokasi) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Koordinat GPS</label>
                    <input type="text" name="koordinat_gps" value="{{ old('koordinat_gps', $rambu->koordinat_gps) }}" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Kondisi</label>
                    <select name="kondisi" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Baik" {{ $rambu->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak" {{ $rambu->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="Perlu Perbaikan" {{ $rambu->kondisi == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                        Foto Rambu 
                        @if(!$rambu->foto)
                            <span class="text-red-600 font-bold">*</span> <small class="text-gray-500 dark:text-gray-400">(WAJIB karena belum ada foto)</small>
                        @else
                            <small class="text-gray-500 dark:text-gray-400">(kosongkan jika tidak ingin ganti)</small>
                        @endif
                    </label>
                    <input type="file" name="foto" accept="image/*" 
                           {{ !$rambu->foto ? 'required' : '' }}
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    
                    @if($rambu->foto)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Foto saat ini:</p>
                            <img src="{{ asset('storage/'.$rambu->foto) }}" class="w-48 h-48 object-cover rounded-lg shadow">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 font-bold">
                    Update Rambu
                </button>
                <a href="{{ route('rambu.index') }}" class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection