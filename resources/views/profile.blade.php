<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700;900&display=swap');
        body { font-family: 'Space Grotesk', sans-serif; }
        .brutalist-card {
            border: 4px solid black;
            box-shadow: 8px 8px 0px 0px rgba(0,0,0,1);
        }
        .brutalist-button {
            border: 4px solid black;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
            transition: all 0.1s;
        }
        .brutalist-button:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
        }
    </style>
</head>
<body class="bg-white text-black min-h-screen flex flex-col selection:bg-[#00ffff] selection:text-black">

    <nav class="fixed w-full z-50 p-4 select-none">
        <div class="max-w-5xl mx-auto bg-white border-4 border-black px-6 py-4 flex justify-between items-center shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <a href="/" class="text-3xl font-black italic tracking-tighter uppercase">
                STORE<span class="text-cyan-500">.</span>
            </a>
            <div class="flex items-center gap-4">
                <a href="/" class="text-xs font-black uppercase tracking-widest text-black hover:text-cyan-500 transition px-2 py-1">
                    Marketplace
                </a>
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-black bg-[#00ffff] border-2 border-black px-4 py-2 hover:bg-black hover:text-[#00ffff] transition-all shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-5xl w-full mx-auto p-6 pt-36 md:pb-12 space-y-12">
        
        <div>
            <h2 class="text-5xl md:text-6xl font-black tracking-tighter uppercase leading-none italic select-none">
                Akun_Saya<span class="text-cyan-500">.</span>
            </h2>
            <p class="text-[10px] font-bold text-gray-400 mt-3 uppercase tracking-[0.3em]">Status Akun: <span class="text-black">Aktif</span></p>
        </div>

        @if(session('success'))
            <div class="border-4 border-black p-4 bg-green-100 font-black uppercase tracking-widest text-xs shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] select-none">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="space-y-6">
                <div class="brutalist-card bg-white p-6 relative">
                    <div class="absolute top-0 right-0 bg-black text-white px-3 py-0.5 text-[8px] font-black tracking-widest uppercase italic select-none">
                        User_Info
                    </div>
                    
                    <div class="flex items-center gap-4 mb-6 mt-2 select-none">
                        <div class="w-14 h-14 bg-[#00ffff] border-4 border-black flex items-center justify-center text-xl font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-black tracking-tight leading-none">{{ auth()->user()->name ?? 'Guest User' }}</h3>
                            <p class="text-[9px] font-bold text-gray-400 mt-1 uppercase">Role: {{ auth()->user()->role ?? 'Customer' }}</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 block mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" 
                                   class="w-full border-2 border-black px-3 py-2 text-xs font-bold uppercase focus:outline-none focus:bg-cyan-50">
                        </div>

                        <div>
                            <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 block mb-1">Alamat Email</label>
                            <input type="email" value="{{ auth()->user()->email ?? '' }}" 
                                   class="w-full border-2 border-black px-3 py-2 text-xs font-bold focus:outline-none bg-gray-100 cursor-not-allowed select-none" readonly>
                        </div>

                        <button type="submit" class="w-full bg-[#00ffff] brutalist-button py-3 font-black text-xs uppercase tracking-widest mt-2 select-none">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <div class="brutalist-card bg-black text-white p-6 select-none">
                    <p class="text-[10px] font-black text-cyan-400 uppercase tracking-widest mb-1 italic">Total Belanja</p>
                    <p class="text-3xl font-black italic">Rp {{ number_format($totalSpent ?? 0, 0, ',', '.') }}</p>
                    <p class="text-[8px] font-bold text-gray-400 mt-2 uppercase">Hanya menghitung transaksi dengan status completed/success.</p>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                
                <div class="brutalist-card bg-white h-full">
                    <div class="bg-black text-white p-4 flex justify-between items-center select-none">
                        <h4 class="font-black text-xs tracking-[0.4em] uppercase italic">Riwayat_Transaksi</h4>
                        <span class="text-cyan-400 text-xs font-black">{{ $orders->count() ?? 0 }} Pesanan</span>
                    </div>

                    <div class="divide-y-4 divide-black">
                        @forelse($orders ?? [] as $order)
                            <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-cyan-50 transition-colors">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-xs font-black italic">#ORD-{{ $order->id }}</span>
                                        @if(in_array(strtolower($order->status), ['completed', 'success']))
                                            <span class="bg-green-300 border-2 border-black px-2 py-0.5 text-[8px] font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">Berhasil</span>
                                        @elseif(strtolower($order->status) == 'pending')
                                            <span class="bg-[#00ffff] border-2 border-black px-2 py-0.5 text-[8px] font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">Pending</span>
                                        @else
                                            <span class="bg-red-400 border-2 border-black px-2 py-0.5 text-[8px] font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">{{ $order->status }}</span>
                                        @endif
                                    </div>
                                    <p class="text-sm font-black uppercase mt-2">{{ $order->product->name ?? 'Produk Terhapus' }}</p>
                                    <p class="text-[9px] font-bold text-gray-500 mt-1 uppercase">Tanggal: {{ $order->created_at->format('d M Y - H:i') }}</p>
                                </div>

                                <div class="flex items-center justify-between md:flex-col md:items-end gap-2">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider leading-none select-none">Total Bayar</p>
                                    <p class="text-lg font-black italic">Rp {{ number_format($order->total_price ?? ($order->price * $order->quantity), 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center select-none">
                                <p class="text-xs font-black text-gray-400 uppercase">Belum ada aktivitas belanja.</p>
                                <a href="/" class="mt-4 inline-block bg-black text-white px-4 py-2 text-xs font-black uppercase hover:bg-cyan-400 hover:text-black transition">Buka Toko</a>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="border-t-4 border-black bg-black text-white px-6 md:px-12 py-6 mt-auto flex flex-col md:flex-row justify-between items-center gap-4 select-none">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            &copy; 2026 <span class="text-white font-black italic">STORE_INFRASTRUCTURE</span>. All Rights Reserved.
        </p>
    </footer>

</body>
</html>