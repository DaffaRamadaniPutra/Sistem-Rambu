@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-200">Tambah Pengguna Baru</h1>

    <form action="{{ route('users.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-400">Nama Lengkap <span class="text-red-600">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-400">NIP <span class="text-red-600">*</span></label>
                <input type="text" name="nip" value="{{ old('nip') }}" maxlength="18" placeholder="198001012005011001" required class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-400">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-400">Role <span class="text-red-600">*</span></label>
                <select name="role" required class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="petugas">Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-400">Password <span class="text-red-600">*</span></label>
                <input type="password" name="password" required class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-400">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold">Simpan</button>
        </div>
    </form>
</div>
@endsection