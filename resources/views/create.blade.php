<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-semibold">Nama Produk</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Harga</label>
                    <input type="number" name="price" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block font-semibold">Stok</label>
                    <input type="number" name="stock" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <div>
                <label class="block font-semibold">Kategori</label>
                <input type="text" name="category" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="4" required></textarea>
            </div>
            <div>
                <label class="block font-semibold">Gambar Produk</label>
                <input type="file" name="image" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Produk</button>
        </form>
    </div>
</body>
</html>