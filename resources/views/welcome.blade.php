<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Next-Gen Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700;900&display=swap');
        body { font-family: 'Space Grotesk', sans-serif; overflow-x: hidden; }
        
        .brutalist-card {
            border: 3px solid #000;
            /* Efek transisi halus */
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        }
        
        /* Bayangan tipis yang tidak mencolok saat di-hover */
        .brutalist-card:hover {
            transform: translate(-3px, -3px) scale(1.02);
            box-shadow: 6px 6px 0px 0px #000 !important;
            z-index: 10;
        }

        /* Menghilangkan scrollbar pada kategori mobile */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; overflow: -moz-scrollbars-none; }
    </style>
</head>
<body class="bg-amber-50 text-black min-h-screen flex flex-col selection:bg-pink-400 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <nav class="fixed w-full z-50 p-3 sm:p-4 select-none">
        <div class="max-w-5xl mx-auto bg-white border-3 border-black px-4 sm:px-6 py-2 sm:py-3 flex justify-between items-center shadow-[4px_4px_0px_0px_#000]">
            <h1 class="text-2xl sm:text-3xl font-black italic tracking-tighter uppercase select-none">
                STORE<span class="text-pink-500">.</span>
            </h1>
            
            <div class="hidden md:flex items-center gap-4">
                @guest
                    <a href="/login" class="text-xs font-black uppercase tracking-widest text-black hover:text-pink-500 transition px-2 py-1">Login</a>
                    <a href="/register" class="bg-[#00ffff] border-2 border-black px-4 py-2 text-xs font-black uppercase tracking-widest hover:bg-black hover:text-[#00ffff] transition-all shadow-[3px_3px_0px_0px_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">Registrasi</a>
                @else
                    <a href="{{ route('profile.index') }}" 
                       class="text-xs font-black bg-yellow-300 border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition-all shadow-[3px_3px_0px_0px_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none select-none">
                       <i class="fas fa-user-circle mr-1"></i> Akun Saya
                    </a>

                    @if(Auth::user()->role === 'admin' || Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" 
                           class="text-xs font-black bg-purple-400 text-white border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition-all shadow-[3px_3px_0px_0px_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
                           ⚙ Admin
                        </a>
                    @endif

                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs font-black bg-pink-400 border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition-all shadow-[3px_3px_0px_0px_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>

            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-xl border-2 border-black p-2 hover:bg-black hover:text-white transition bg-yellow-300 relative z-50">
                <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>
        </div>

        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-full" @click.away="mobileMenuOpen = false" class="md:hidden fixed inset-0 bg-amber-50 z-40 p-10 pt-24 border-b-3 border-black flex flex-col gap-4 select-none overflow-y-auto">
            @guest
                <a href="/login" class="text-sm font-black uppercase tracking-widest text-center border-2 border-black py-3 hover:bg-black hover:text-white transition bg-white">Login</a>
                <a href="/register" class="bg-[#00ffff] border-2 border-black py-3 text-sm font-black uppercase tracking-widest text-center shadow-[4px_4px_0px_0px_#000]">Registrasi</a>
            @else
                <a href="{{ route('profile.index') }}" class="text-sm font-black border-2 border-black py-3 text-center bg-yellow-300 shadow-[4px_4px_0px_0px_#000]">
                   <i class="fas fa-user-circle mr-2"></i> Akun Saya
                </a>

                @if(Auth::user()->role === 'admin' || Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-black border-2 border-black py-3 text-center bg-purple-400 text-white shadow-[4px_4px_0px_0px_#000]">
                       ⚙ Admin_Console
                    </a>
                @endif

                <form action="/logout" method="POST" class="w-full mt-4">
                    @csrf
                    <button type="submit" class="w-full text-sm font-black bg-pink-400 border-2 border-black py-3 shadow-[4px_4px_0px_0px_#000] uppercase">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </nav>

    <header class="min-h-[80vh] flex items-center justify-center text-center px-4 sm:px-6 pt-32 pb-16 border-b-4 border-black bg-pink-100 bg-[radial-gradient(#000_1px,transparent_1px)] [background-size:20px_20px]">
        <div data-aos="zoom-out-up" data-aos-duration="1200" class="max-w-4xl">
            <span class="bg-black text-yellow-300 text-[9px] sm:text-[10px] font-black px-3 py-1 tracking-widest uppercase border border-black select-none">System_Version: v1.0.4_Stable</span>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black mt-6 mb-8 leading-tight tracking-tight uppercase italic break-words relative">
                Gadget Impian<br>
                <span class="relative inline-block mt-2">
                    <span class="absolute inset-0 bg-black transform translate-x-1.5 translate-y-1.5"></span>
                    <span class="relative text-pink-500 bg-white border-3 border-black px-6 py-1 inline-block transform -rotate-1">Di Ujung Jari.</span>
                </span>
            </h1>
            <a href="#produk" class="inline-block px-6 sm:px-10 py-3 sm:py-4 bg-green-400 text-black font-black text-xs uppercase tracking-widest border-3 border-black hover:bg-yellow-300 hover:shadow-[5px_5px_0px_0px_#000] hover:-translate-y-1 transition-all duration-300 select-none shadow-[3px_3px_0px_0px_#000]">
                Jelajahi Produk <i class="fas fa-arrow-down ml-2 animate-bounce"></i>
            </a>
        </div>
    </header>

    <main id="produk" class="max-w-6xl w-full mx-auto px-4 sm:px-6 py-12 sm:py-20 bg-amber-50" x-data="{ selectedCategory: 'Semua' }">
        
        <div class="mb-10 sm:mb-16 flex flex-wrap gap-2 sm:gap-3 justify-center select-none overflow-x-auto pb-4 scrollbar-hide md:overflow-x-visible md:pb-0" data-aos="fade-down" data-aos-delay="300">
            <button @click="selectedCategory = 'Semua'" 
                    :class="selectedCategory === 'Semua' ? 'bg-black text-white shadow-[3px_3px_0px_0px_#00ffff] translate-y-[-1px]' : 'bg-white text-black border-2 border-black hover:bg-pink-100'"
                    class="px-5 sm:px-7 py-2 border-2 border-black font-black text-[10px] sm:text-xs uppercase tracking-widest transition-all duration-300 whitespace-nowrap">
                Semua
            </button>
            <button @click="selectedCategory = 'Laptop'" 
                    :class="selectedCategory === 'Laptop' ? 'bg-yellow-300 text-black shadow-[3px_3px_0px_0px_#000] translate-y-[-1px]' : 'bg-white text-black border-2 border-black hover:bg-yellow-50'"
                    class="px-5 sm:px-7 py-2 border-2 border-black font-black text-[10px] sm:text-xs uppercase tracking-widest transition-all duration-300 whitespace-nowrap">
                Laptop
            </button>
            <button @click="selectedCategory = 'HP'" 
                    :class="selectedCategory === 'HP' ? 'bg-[#00ffff] text-black shadow-[3px_3px_0px_0px_#000] translate-y-[-1px]' : 'bg-white text-black border-2 border-black hover:bg-cyan-50'"
                    class="px-5 sm:px-7 py-2 border-2 border-black font-black text-[10px] sm:text-xs uppercase tracking-widest transition-all duration-300 whitespace-nowrap">
                HP
            </button>
            <button @click="selectedCategory = 'Keyboard'" 
                    :class="selectedCategory === 'Keyboard' ? 'bg-pink-400 text-white shadow-[3px_3px_0px_0px_#000] translate-y-[-1px]' : 'bg-white text-black border-2 border-black hover:bg-pink-50'"
                    class="px-5 sm:px-7 py-2 border-2 border-black font-black text-[10px] sm:text-xs uppercase tracking-widest transition-all duration-300 whitespace-nowrap">
                Keyboard
            </button>
            <button @click="selectedCategory = 'Monitor'" 
                    :class="selectedCategory === 'Monitor' ? 'bg-green-400 text-black shadow-[3px_3px_0px_0px_#000] translate-y-[-1px]' : 'bg-white text-black border-2 border-black hover:bg-green-50'"
                    class="px-5 sm:px-7 py-2 border-2 border-black font-black text-[10px] sm:text-xs uppercase tracking-widest transition-all duration-300 whitespace-nowrap">
                Monitor
            </button>
            <button @click="selectedCategory = 'Aksesoris'" 
                    :class="selectedCategory === 'Aksesoris' ? 'bg-orange-400 text-black shadow-[3px_3px_0px_0px_#000] translate-y-[-1px]' : 'bg-white text-black border-2 border-black hover:bg-orange-50'"
                    class="px-5 sm:px-7 py-2 border-2 border-black font-black text-[10px] sm:text-xs uppercase tracking-widest transition-all duration-300 whitespace-nowrap">
                Aksesoris
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            @foreach($products as $index => $p)
                @php
                    $cardColors = ['bg-yellow-100', 'bg-cyan-100', 'bg-pink-100', 'bg-green-100', 'bg-orange-100', 'bg-purple-100'];
                    $btnColors = ['bg-yellow-400', 'bg-[#00ffff]', 'bg-pink-400', 'bg-green-400', 'bg-orange-400', 'bg-purple-400'];
                    $aosEffects = ['zoom-in-up', 'fade-up', 'flip-left'];
                    
                    $currentColor = $cardColors[$index % count($cardColors)];
                    $currentBtn = $btnColors[$index % count($btnColors)];
                    $currentAos = $aosEffects[$index % count($aosEffects)];
                @endphp
                <div class="{{ $currentColor }} p-5 brutalist-card flex flex-col justify-between min-h-[440px] h-full select-none shadow-[4px_4px_0px_0px_#000]"
                     x-show="selectedCategory === 'Semua' || selectedCategory === '{{ $p->category }}'"
                     x-transition:enter="transition ease-out duration-400"
                     x-transition:enter-start="opacity-0 scale-50 rotate-[-5deg]"
                     x-transition:enter-end="opacity-100 scale-100 rotate-0"
                     data-aos="{{ $currentAos }}"
                     data-aos-duration="800"
                     data-aos-delay="{{ ($index % 4) * 150 }}"
                     data-aos-once="false">
                    
                    <div>
                        <div class="overflow-hidden bg-white aspect-square border-2 border-black mb-4 flex items-center justify-center p-2 relative transform transition-transform duration-500 hover:scale-105">
                            @if($p->image)
                                <img src="{{ asset('uploads/'.$p->image) }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-4">
                                    <i class="fas fa-box text-3xl text-slate-300 mb-1"></i>
                                    <p class="text-[9px] font-black uppercase text-slate-400">No Image</p>
                                </div>
                            @endif
                        </div>
                        
                        <div class="space-y-2">
                            <span class="text-[9px] sm:text-[10px] font-black tracking-wider bg-black text-white px-2 py-0.5 uppercase">
                                {{ $p->category ?? 'Device' }}
                            </span>
                            <h3 class="font-black text-base sm:text-lg text-black leading-tight uppercase italic break-words pt-1">
                                {{ $p->name }}
                            </h3>
                            <p class="text-white bg-black inline-block px-2.5 py-0.5 font-black text-xs sm:text-sm tracking-tight border border-black transform rotate-1 shadow-[2px_2px_0px_0px_#ff00ff]">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="border-t-2 border-black pt-4 mt-4">
                        @auth
                            @if($p->stock > 0)
                                <a href="{{ route('checkout', $p->id) }}" 
                                   class="block text-center {{ $currentBtn }} border-2 border-black py-2.5 text-xs font-black uppercase tracking-widest text-black shadow-[3px_3px_0px_0px_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all duration-300">
                                   Beli Sekarang <i class="fas fa-shopping-cart ml-1.5"></i>
                                </a>
                            @else
                                <button disabled 
                                        class="block w-full text-center bg-gray-100 text-gray-400 border-2 border-black py-2.5 text-xs font-black uppercase tracking-widest cursor-not-allowed shadow-[3px_3px_0px_0px_#ccc]">
                                    Stok Habis
                                </button>
                            @endif
                        @else
                            <a href="/login" class="block text-center bg-white text-black border-2 border-black py-2.5 text-xs font-black uppercase tracking-widest shadow-[3px_3px_0px_0px_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition duration-300">
                                Login untuk Beli <i class="fas fa-sign-in-alt ml-1.5"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <footer class="border-t-4 border-black bg-black text-white px-5 sm:px-8 md:px-12 py-6 sm:py-8 mt-auto flex flex-col md:flex-row justify-between items-center gap-5 select-none relative overflow-hidden">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest text-center md:text-left relative z-10">
            &copy; 2026 <span class="text-pink-400 font-black italic">STORE_INFRASTRUCTURE</span>. All Rights Reserved.
        </p>
        <p class="text-xs font-bold text-yellow-300 uppercase tracking-widest text-center md:text-right relative z-10">
            Control_Unit // SEC_BETA_V4 <i class="fas fa-bolt ml-1 animate-pulse"></i>
        </p>
    </footer>

    <script> 
        AOS.init({ 
            once: false,
            duration: 800,
            easing: 'ease-out-back',
            offset: 100,
            delay: 100,
        }); 
    </script>
</body>
</html>