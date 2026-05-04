<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Checkout - {{ $product->name }}</title>
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
                Secure_Checkout
            </span>
        </div>
        <a href="/" class="text-xs font-black uppercase tracking-widest border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </header>

    <main class="flex-1 max-w-4xl mx-auto px-6 py-12 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-4 border-black p-6 md:p-10 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] bg-white select-none">
            
            <div class="flex flex-col justify-between h-full">
                <div>
                    <div class="mb-4">
                        <span class="text-[10px] font-black tracking-wider bg-black text-white px-3 py-1 uppercase border border-black">
                            {{ $product->category ?? 'Device' }}
                        </span>
                    </div>

                    <div class="overflow-hidden bg-gray-50 aspect-square border-4 border-black mb-6 flex items-center justify-center p-2 relative">
                        @if($product->image)
                            <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-center p-4">
                                <i class="fas fa-box-open text-4xl mb-2 text-gray-300"></i>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">No Image Available</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="border-t-2 border-black pt-4 bg-white">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Base_Price</p>
                    <p class="text-3xl font-black italic text-black">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-widest">
                        Stok Tersedia: <span class="text-black font-black">{{ $product->stock }} Unit</span>
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-between border-t-4 md:border-t-0 md:border-l-4 border-black pt-6 md:pt-0 md:pl-8">
                <div>
                    <h2 class="text-3xl font-black tracking-tighter uppercase italic leading-none mb-2">
                        Review_Order
                    </h2>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">
                        Lengkapi detail untuk melanjutkan pembelian
                    </p>

                    <div class="border-2 border-black p-4 bg-gray-50 mb-6">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Item_Name</p>
                        <h3 class="text-lg font-black italic leading-tight mt-0.5 truncate">
                            {{ $product->name }}
                        </h3>
                    </div>

                    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="total_price" value="{{ $product->price }}">

                        <div class="space-y-2">
                            <label for="shipping_address" class="text-xs font-black uppercase tracking-widest block">
                                Alamat Pengiriman (Node_Destination)
                            </label>
                            <textarea id="shipping_address" name="shipping_address" rows="2" required 
                                      class="w-full border-4 border-black p-3 text-sm font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" 
                                      placeholder="Masukkan alamat lengkap..."></textarea>
                        </div>

                        <div class="space-y-2">
                            <label for="payment_method" class="text-xs font-black uppercase tracking-widest block">
                                Metode Pembayaran (Payment_Method)
                            </label>
                            <select id="payment_method" name="payment_method" required
                                    class="w-full border-4 border-black p-3 text-sm font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-white cursor-pointer transition-all">
                                <option value="" disabled selected>Pilih metode bayar</option>
                                <option value="QRIS">QRIS / E-Wallet</option>
                                <option value="BANK_TRANSFER">Transfer Bank</option>
                                <option value="COD">COD (Bayar di Tempat)</option>
                            </select>
                        </div>

                        <div class="pt-2">
                            @if($product->stock > 0)
                                <button type="submit" 
                                        class="w-full bg-[#00ffff] border-4 border-black py-4 font-black text-sm uppercase tracking-widest shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-300">
                                    Konfirmasi Pembelian <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            @else
                                <button disabled 
                                        class="w-full bg-gray-200 text-gray-400 border-4 border-black py-4 font-black text-sm uppercase tracking-widest cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
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