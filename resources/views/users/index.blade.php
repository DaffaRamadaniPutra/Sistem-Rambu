@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200">Kelola Pengguna</h1>
        <a href="{{ route('users.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg transition">
            + Tambah Pengguna
        </a>
    </div>

    {{-- Flash Message Success --}}
    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 rounded mb-6 flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-900 dark:text-green-500 text-xl hover:opacity-70">&times;</button>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gradient-to-r from-blue-800 to-blue-900 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">NIP</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($users as $i => $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                {{ $users->firstItem() + $i }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-gray-100">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-900 dark:text-gray-100">
                                {{ $user->nip }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-4 py-2 rounded-full text-xs font-bold text-white {{ $user->role == 'admin' ? 'bg-red-600' : 'bg-indigo-600' }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-6">
                                <a href="{{ route('users.edit', $user) }}"
                                   class="text-blue-600 dark:text-blue-400 hover:underline font-medium transition">
                                    Edit
                                </a>

                                @if($user->id !== auth()->id())
                                    <button type="button"
                                            onclick="confirmDelete('{{ route('users.destroy', $user) }}', '{{ addslashes($user->name) }}')"
                                            class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-bold transition">
                                        Hapus
                                    </button>
                                @else
                                    <span class="text-gray-400 dark:text-gray-600 text-sm italic">Diri sendiri</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16 text-gray-500 dark:text-gray-400 text-xl">
                                Belum ada pengguna
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $users->links() }}
    </div>
</div>
@endsection