@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-200">Edit Pengguna</h1>

    <form action="{{ route('users.update', $user) }}" method="POST" 
          class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-300">
                    Nama Lengkap <span class="text-red-600">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       required 
                       class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                              rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-300">
                    NIP <span class="text-red-600">*</span>
                </label>
                <input type="text" 
                       name="nip" 
                       value="{{ old('nip', $user->nip) }}" 
                       maxlength="18" 
                       required 
                       class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                              rounded-lg focus:ring-2 focus:ring-blue-500 transition">
                @error('nip')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-300">
                    Email <span class="text-red-600">*</span>
                </label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       required 
                       class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                              rounded-lg focus:ring-2 focus:ring-blue-500 transition">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-300">
                    Role <span class="text-red-600">*</span>
                </label>
                <select name="role" 
                        required 
                        class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 
                               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                               rounded-lg focus:ring-2 focus:ring-blue-500 transition">
                    <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-600 dark:text-gray-400">
                    Password Baru <small class="text-xs">(kosongkan jika tidak diganti)</small>
                </label>
                <input type="password" 
                       name="password" 
                       class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                              rounded-lg focus:ring-2 focus:ring-blue-500 transition">
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-600 dark:text-gray-400">
                    Konfirmasi Password
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       class="mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                              rounded-lg focus:ring-2 focus:ring-blue-500 transition">
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('users.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition">
                Batal
            </a>
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-bold transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection