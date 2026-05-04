<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F8F9FB] min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-6">
        <h1 class="text-3xl font-black mb-8">Riwayat Pesanan</h1>
        
        <div class="grid gap-4">
            @forelse($orders as $order)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg">{{ $order->product->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        <span class="inline-block mt-2 px-3 py-1 text-xs font-bold rounded-full 
                            {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-600' : 'bg-green-100 text-green-600' }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-blue-600">Rp {{ number_format($order->total_price) }}</p>
                        <p class="text-xs text-gray-400">{{ $order->payment_method }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 py-10">Belum ada riwayat pesanan.</p>
            @endforelse
        </div>
        
        <a href="/" class="block mt-8 text-center font-bold text-gray-500 hover:text-gray-900 transition">← Kembali ke Beranda</a>
    </div>
</body>
</html>