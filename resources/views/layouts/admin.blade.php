<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-100 flex">
    <div class="w-64 bg-gray-900 min-h-screen p-6 text-white fixed">
        <h1 class="text-xl font-black mb-10">ADMIN PANEL</h1>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block p-3 rounded-xl hover:bg-gray-800 font-bold">📊 Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block p-3 rounded-xl hover:bg-gray-800 font-bold">📦 Produk</a>
            <a href="{{ route('admin.orders') }}" class="block p-3 rounded-xl hover:bg-gray-800 font-bold">🛒 Pesanan</a>
            <a href="{{ route('admin.users') }}" class="block p-3 rounded-xl hover:bg-gray-800 font-bold">👥 User</a>
        </nav>
    </div>
    <div class="ml-64 flex-1 p-10">@yield('content')</div>
</body>
</html>