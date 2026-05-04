<body class="bg-[#F8F9FB] min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white/70 backdrop-blur-xl border border-white shadow-2xl rounded-[2rem] p-8">
        <h2 class="text-3xl font-black gradient-text mb-2">Selamat Datang</h2>
        <p class="text-gray-500 mb-8">Login ke akun Store kamu.</p>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="email" name="email" placeholder="Email" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>
            <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200">Login Sekarang</button>
        </form>

        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
            <div class="relative flex justify-center text-sm"><span class="bg-[#F8F9FB] px-2 text-gray-400">ATAU</span></div>
        </div>

        <a href="{{ url('/auth/google') }}" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-200 py-3 rounded-xl hover:bg-gray-50 transition font-bold text-gray-700">
            Login dengan Google
        </a>

        <p class="mt-6 text-center text-sm text-gray-500">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Registrasi</a></p>
    </div>
</body>