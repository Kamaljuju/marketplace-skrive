<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-800">Edit Produk</h1>
            <p class="text-gray-500">Perbarui data: <span class="font-bold text-blue-600">{{ $product->name }}</span></p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-500/20 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-500/20 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Stok</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-500/20 outline-none transition">
                    </div>
<div class="col-span-2">
    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
    <select name="category" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-500/20 outline-none transition">
        <option value="Smartphone" {{ $product->category == 'Smartphone' ? 'selected' : '' }}>Smartphone</option>
        <option value="Laptop" {{ $product->category == 'Laptop' ? 'selected' : '' }}>Laptop</option>
        <option value="Aksesoris" {{ $product->category == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
        <option value="Keyboard" {{ $product->category == 'Keyboard' ? 'selected' : '' }}>Keyboard</option>
        <option value="Monitor" {{ $product->category == 'Monitor' ? 'selected' : '' }}>Monitor</option>
    </select>
</div>
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-500/20 outline-none transition">{{ $product->description }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Gambar (Opsional)</label>
                        <img src="{{ asset('uploads/'.$product->image) }}" class="w-24 h-24 rounded-2xl object-cover mb-3">
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700">
                    </div>
                </div>

                <div class="flex gap-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.products.index') }}" class="flex-1 text-center py-3 rounded-xl font-bold text-gray-600 hover:bg-gray-100 transition">Batal</a>
                    <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition hover:scale-[1.02]">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>