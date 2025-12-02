<!DOCTYPE html>
<html class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-gradient-to-br from-green-600 to-blue-700 flex items-center justify-center">
    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md">
        <h1 class="text-3xl font-bold text-center mb-8">Registrasi Akun</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nama Lengkap">

            <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Email">

            <input type="text" name="nip" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="NIP (Nomor Induk Pegawai)" maxlength="18" pattern="[0-9]{18}" title="NIP harus berupa 18 digit angka">

            <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Password">

            <input type="password" name="password_confirmation" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Konfirmasi Password">

            <select name="role" class="w-full p-3 border border-gray-300 rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="petugas">Petugas</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700 transition duration-200">
                Daftar
            </button>
        </form>
    </div>
</body>
</html>