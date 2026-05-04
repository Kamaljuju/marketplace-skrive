<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap');
        body { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="bg-white text-black min-h-screen flex flex-col selection:bg-[#00ffff] selection:text-black">

    <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-6 md:px-12 sticky top-0 z-50">
        <a href="/" class="text-3xl font-black italic tracking-tighter uppercase select-none">
            STORE<span class="text-cyan-500">.</span>
        </a>
        <a href="/" class="text-xs font-black uppercase tracking-widest border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
            Home <i class="fas fa-home ml-1"></i>
        </a>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center px-6 py-12">
        <div class="w-full max-w-md border-4 border-black p-6 md:p-8 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-black tracking-tighter uppercase italic leading-none mb-2">Sign_In</h2>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                    Akses akun belanja kamu
                </p>
            </div>

            @if ($errors->any())
                <div class="border-2 border-black p-3 bg-red-100 mb-6 text-left">
                    <p class="text-xs font-black uppercase tracking-widest text-red-600 mb-1">Error Detected:</p>
                    <ul class="list-disc list-inside text-xs font-bold text-red-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="text-xs font-black uppercase tracking-widest block">Email_Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full border-4 border-black pl-10 pr-3 py-3 font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" 
                               placeholder="kamu@email.com">
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="password" class="text-xs font-black uppercase tracking-widest block">User_Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-gray-400"></i>
                        </span>
                        <input type="password" id="password" name="password" required
                               class="w-full border-4 border-black pl-10 pr-3 py-3 font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" 
                               placeholder="********">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center select-none cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 border-2 border-black accent-black rounded-none">
                        <span class="ml-2 text-xs font-black uppercase tracking-widest">Remember_Me</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#00ffff] border-4 border-black py-4 font-black text-sm uppercase tracking-widest shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all text-center">
                        Masuk Sekarang <i class="fas fa-sign-in-alt ml-1"></i>
                    </button>
                </div>
            </form>

            <div class="relative my-6 text-center select-none">
                <span class="bg-white px-3 text-[10px] font-black uppercase tracking-widest text-gray-400 relative z-10">Atau</span>
                <div class="border-t-2 border-dashed border-gray-300 absolute inset-0 top-1/2"></div>
            </div>

            <a href="/auth/google" class="w-full bg-white border-4 border-black py-3.5 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center justify-center gap-3">
                <i class="fab fa-google text-lg"></i> Sign in with Google
            </a>

            <div class="mt-6 text-center">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-black font-black underline decoration-2 decoration-cyan-500 hover:text-cyan-500 transition">Register</a>
                </p>
            </div>

        </div>
    </main>

    <footer class="border-t-4 border-black bg-black text-white px-6 md:px-12 py-6 mt-auto flex flex-col md:flex-row justify-between items-center gap-4 select-none">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            &copy; 2026 <span class="text-white font-black italic">STORE_INFRASTRUCTURE</span>.
        </p>
        <p class="text-[10px] font-bold text-cyan-400 uppercase tracking-widest">
            Identity_Auth // SEC_BETA_V4
        </p>
    </footer>

</body>
</html>