@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">Tambah Rambu Baru</h1>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
        <form action="{{ route('rambu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Nama Rambu</label>
                    <input type="text" name="nama_rambu" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Jenis Rambu</label>
                    <select name="jenis" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Larangan">Larangan</option>
                        <option value="Peringatan">Peringatan</option>
                        <option value="Petunjuk">Petunjuk</option>
                        <option value="Perintah">Perintah</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Lokasi</label>
                    <input type="text" name="lokasi" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Jl. Ahmad Yani, Kec. Lowokwaru">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Koordinat GPS (Opsional)</label>
                    <input type="text" name="koordinat_gps" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="-7.123456, 112.654321">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Kondisi Rambu</label>
                    <select name="kondisi" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                        Foto Rambu <span class="text-red-600 font-bold">*</span> <small class="text-gray-500 dark:text-gray-400">(WAJIB)</small>
                    </label>
                    <input type="file" name="foto" accept="image/*" required 
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-red-500">
                    <p class="text-xs text-red-600 mt-2">
                        Wajib upload foto rambu! Format JPG/PNG, maksimal 3MB.
                    </p>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-bold">
                    Simpan Rambu
                </button>
                <a href="{{ route('rambu.index') }}" class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection