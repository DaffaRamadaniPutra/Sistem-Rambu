<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="{{ asset('images/logo_dishub.png') }}" type="image/png">
    <title>Login | Dishub Kota Cirebon</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .logo-shadow {
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
        }
    </style>
</head>
<body class="h-full bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-800 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">
        
        <!-- HEADER -->
        <div class="bg-gradient-to-b from-blue-600 to-blue-800 p-10 text-center">
            <div class="w-32 h-32 mx-auto mb-6 rounded-full bg-white p-4 shadow-2xl logo-shadow border-4 border-white">
                <img src="{{ asset('images/logo_dishub.png') }}" 
                     alt="Logo Dishub Kota Cirebon" 
                     class="w-full h-full object-contain rounded-full"
                     onerror="this.src='https://upload.wikimedia.org/wikipedia/id/4/4f/Logo_Dishub_Kota_Cirebon.png'">
            </div>
            <h1 class="text-3xl font-black text-white tracking-wider">DISHUB</h1>
            <p class="text-yellow-300 font-bold text-lg -mt-2">KOTA CIREBON</p>
        </div>

        <!-- FORM LOGIN -->
        <div class="p-10">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">
                Login Sistem Rambu
            </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-blue-600"></i>Email
                        </label>
                        <input type="email" name="email" required autofocus
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
                               placeholder="masukkan email anda">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                        </label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
                               placeholder="masukkan kata sandi">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mt-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <button type="submit" 
                        class="w-full mt-8 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-black text-lg py-4 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    MASUK KE SISTEM
                </button>
            </form>

            <div class="text-center mt-8 text-sm text-gray-600">
                <p>© {{ date('Y') }} Dinas Perhubungan Kota Cirebon</p>
            </div>
        </div>
    </div>
</body>
</html>