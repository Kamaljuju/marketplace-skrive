<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FB] py-12 px-6">
    <form action="/checkout/process" method="POST" class="max-w-lg mx-auto bg-white p-8 rounded-[2rem] shadow-lg">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        
        <h2 class="text-3xl font-black mb-6">Checkout</h2>
        <div class="bg-gray-50 p-4 rounded-2xl mb-6">
            <p class="font-bold text-gray-700">{{ $product->name }}</p>
            <p class="text-blue-600 font-black">Rp {{ number_format($product->price) }}</p>
        </div>

        <textarea name="address" placeholder="Alamat Lengkap Pengiriman..." class="w-full p-4 border rounded-2xl mb-6" required></textarea>

        <div class="mb-6">
            <label class="block font-bold mb-3">Metode Pembayaran</label>
            <div class="grid grid-cols-2 gap-4">
                <label class="border p-4 rounded-2xl cursor-pointer hover:border-blue-500">
                    <input type="radio" name="payment" value="QRIS" checked> QRIS
                </label>
                <label class="border p-4 rounded-2xl cursor-pointer hover:border-blue-500">
                    <input type="radio" name="payment" value="COD"> COD
                </label>
            </div>
        </div>
        
        <button type="submit" class="w-full bg-green-600 text-white py-4 rounded-2xl font-bold hover:bg-green-700">Bayar Sekarang</button>
    </form>
</body>
</html>