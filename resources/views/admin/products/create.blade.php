<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Tambah Produk</title>
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
                Admin_Panel
            </span>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-black uppercase tracking-widest border-2 border-black px-4 py-2 hover:bg-black hover:text-white transition shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center px-6 py-12">
        <div class="w-full max-w-2xl border-4 border-black p-6 md:p-8 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            
            <div class="text-left mb-6 border-b-4 border-dashed border-black pb-4">
                <h2 class="text-3xl font-black tracking-tighter uppercase italic leading-none mb-2">Add_New_Product</h2>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                    Masukkan detail gadget terbaru ke inventaris Store
                </p>
            </div>

            @if(session('success'))
                <div class="border-4 border-black p-4 bg-green-100 mb-6 font-black uppercase tracking-widest text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="border-4 border-black p-4 bg-red-100 mb-6 text-left shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <p class="text-xs font-black uppercase tracking-widest text-red-600 mb-1">Error Detected:</p>
                    <ul class="list-disc list-inside text-xs font-bold text-red-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="space-y-1">
                    <label for="name" class="text-xs font-black uppercase tracking-widest block">Product_Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full border-4 border-black p-3 font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" 
                           placeholder="Contoh: iPhone 16 Pro Max">
                </div>

                <div class="space-y-1">
                    <label for="category" class="text-xs font-black uppercase tracking-widest block">Category</label>
                    <select id="category" name="category" required
                            class="w-full border-4 border-black p-3 font-bold focus:outline-none focus:bg-cyan-50 bg-white cursor-pointer transition-all">
                        <option value="" disabled {{ old('category') == '' ? 'selected' : '' }}>Pilih Kategori Produk</option>
                        <option value="Laptop" {{ old('category') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="HP" {{ old('category') == 'HP' ? 'selected' : '' }}>HP</option>
                        <option value="Keyboard" {{ old('category') == 'Keyboard' ? 'selected' : '' }}>Keyboard</option>
                        <option value="Monitor" {{ old('category') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                        <option value="Aksesoris" {{ old('category') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label for="price" class="text-xs font-black uppercase tracking-widest block">Price (Rp)</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0"
                               class="w-full border-4 border-black p-3 font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" 
                               placeholder="Contoh: 15000000">
                    </div>

                    <div class="space-y-1">
                        <label for="stock" class="text-xs font-black uppercase tracking-widest block">Total_Stock</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required min="0"
                               class="w-full border-4 border-black p-3 font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" 
                               placeholder="Contoh: 10">
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="description" class="text-xs font-black uppercase tracking-widest block">Description</label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full border-4 border-black p-3 text-sm font-bold focus:outline-none focus:bg-cyan-50 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" 
                              placeholder="Tulis detail deskripsi produk di sini...">{{ old('description') }}</textarea>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black uppercase tracking-widest block">Product_Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-36 border-4 border-dashed border-black bg-white cursor-pointer hover:bg-cyan-50 hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all relative">
                            
                            <div id="uploadPrompt" class="flex flex-col items-center justify-center">
                                <i class="fas fa-cloud-upload-alt text-3xl mb-2"></i>
                                <span class="text-xs font-black uppercase tracking-widest">Klik untuk upload gambar</span>
                            </div>

                            <img id="imagePreview" class="hidden h-32 object-cover border-2 border-black m-1 select-none">
                            
                            <input type="file" name="image" id="imageInput" required accept="image/*" class="hidden">
                        </label>
                    </div>
                </div>

                <div class="pt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.products.index') }}" 
                       class="w-full bg-white border-4 border-black py-4 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-center">
                         Batal
                    </a>
                    <button type="submit" class="w-full bg-[#00ffff] border-4 border-black py-4 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all text-center">
                        Simpan Produk <i class="fas fa-save ml-1"></i>
                    </button>
                </div>
            </form>

        </div>
    </main>

    <footer class="border-t-4 border-black bg-black text-white px-6 md:px-12 py-6 mt-auto flex flex-col md:flex-row justify-between items-center gap-4 select-none">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
            &copy; 2026 <span class="text-white font-black italic">STORE_INFRASTRUCTURE</span>.
        </p>
        <p class="text-[10px] font-bold text-cyan-400 uppercase tracking-widest">
            Dashboard_Terminal // SEC_BETA_V4
        </p>
    </footer>

    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPrompt = document.getElementById('uploadPrompt');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                
                uploadPrompt.classList.add('hidden');
                imagePreview.classList.remove('hidden');

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>