<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Order Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap');
        body { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="bg-white text-black min-h-screen flex flex-col selection:bg-[#00ffff] selection:text-black">

    <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-6 md:px-12 sticky top-0 z-50">
        <div class="flex items-center gap-8">
            <a href="/" class="text-3xl font-black italic tracking-tighter uppercase select-none">
                STORE<span class="text-cyan-500">.</span>
            </a>
            <span class="text-xs font-black uppercase tracking-widest bg-black text-white px-3 py-1 border border-black select-none hidden md:inline">
                Order_Receipt
            </span>
        </div>
        <a href="/" class="text-xs font-black uppercase tracking-widest border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
            Home <i class="fas fa-home ml-1"></i>
        </a>
    </header>

    <main class="flex-1 max-w-2xl mx-auto px-6 py-12 w-full flex flex-col justify-center">
        <div class="border-4 border-black p-6 md:p-10 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] bg-white select-none text-center">
            
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#00ffff] border-4 border-black rounded-none mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <i class="fas fa-check text-2xl font-black"></i>
            </div>

            <h1 class="text-3xl md:text-4xl font-black tracking-tighter uppercase italic leading-none mb-3">
                Order_Successful
            </h1>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-8">
                Pesanan Anda telah diterima dan sedang diproses.
            </p>

            @if($order->payment_method === 'QRIS')
            <div class="border-4 border-black p-6 bg-cyan-50 mb-8 flex flex-col items-center justify-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-xs font-black uppercase tracking-widest mb-3 text-black">
                    <i class="fas fa-qrcode mr-1"></i> Pindai untuk Membayar
                </p>
                
                <div class="bg-white border-4 border-black p-3 mb-3 select-none">
                    <img src="{{ asset('images/qris.png') }}" 
                         alt="QRIS Code" class="w-48 h-48 object-contain">
                </div>
                
                <p class="text-[10px] font-black uppercase tracking-wider text-gray-600 bg-white border-2 border-black px-3 py-1">
                    QRIS // Scan via GoPay, OVO, Dana, LinkAja, Mobile Banking
                </p>
            </div>
            @endif

            <div class="border-2 border-black p-4 bg-gray-50 mb-8 text-left space-y-3">
                <div class="flex justify-between border-b-2 border-dashed border-gray-300 pb-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Order_ID</span>
                    <span class="text-xs font-black uppercase">#INV-{{ $order->id }}-X</span>
                </div>
                <div class="flex justify-between border-b-2 border-dashed border-gray-300 pb-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Item_Name</span>
                    <span class="text-xs font-black uppercase truncate max-w-[200px] text-right">{{ $order->product->name ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b-2 border-dashed border-gray-300 pb-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Metode_Bayar</span>
                    <span class="text-xs font-black uppercase bg-black text-white px-2 py-0.5">{{ $order->payment_method }}</span>
                </div>
                <div class="flex justify-between border-b-2 border-dashed border-gray-300 pb-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Status</span>
                    <span class="text-xs font-black uppercase text-cyan-600">{{ $order->status }}</span>
                </div>
                <div class="flex justify-between pt-1">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Total_Harga</span>
                    <span class="text-lg font-black uppercase italic">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="border-2 border-black p-4 bg-gray-50 mb-8 text-left">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Node_Destination (Alamat Kirim)</p>
                <p class="text-xs font-bold uppercase mt-1 leading-relaxed text-gray-800">
                    {{ $order->address }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="/history" 
                   class="bg-white border-4 border-black py-3 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-center">
                    <i class="fas fa-history mr-1"></i> Riwayat Belanja
                </a>
                <a href="/" 
                   class="bg-[#00ffff] border-4 border-black py-3 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-center">
                    Lanjut Belanja <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </main>

    <footer class="border-t-4 border-black bg-black text-white px-6 md:px-12 py-6 mt-auto flex flex-col md:flex-row justify-between items-center gap-4 select-none">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            &copy; 2026 <span class="text-white font-black italic">STORE_INFRASTRUCTURE</span>.
        </p>
        <p class="text-[10px] font-bold text-cyan-400 uppercase tracking-widest">
            Control_Unit // SEC_BETA_V4
        </p>
    </footer>

</body>
</html>