<!DOCTYPE html>
<html class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="h-full bg-gradient-to-br from-blue-600 to-purple-700 flex items-center justify-center">
    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <i class="fas fa-road text-6xl text-blue-600"></i>
            <h1 class="text-3xl font-bold mt-4">Login Sistem Rambu</h1>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" required class="w-full p-3 border rounded-lg mb-4" placeholder="Email">
            <input type="password" name="password" required class="w-full p-3 border rounded-lg mb-4" placeholder="Password">
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700">
                Login
            </button>
        </form>
        {{-- <p class="text-center mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600">Daftar</a></p> --}}
    </div>
</body>
</html>