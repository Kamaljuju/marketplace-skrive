<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKRIVE - Stock Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap');
        body { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex">

    <aside class="w-64 bg-white border-r-4 border-black flex flex-col justify-between fixed h-full z-30 select-none">
        <div class="p-6">
            <div class="mb-10">
                <h2 class="text-xl font-black tracking-tighter">ADMIN_CORE_v1</h2>
                <p class="text-[10px] font-bold text-gray-500 uppercase">System_Status: <span class="text-cyan-500">Active</span></p>
            </div>

            <nav class="space-y-3">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 p-3 font-black uppercase text-xs tracking-widest transition-all border-2 {{ request()->routeIs('admin.dashboard') ? 'bg-[#00ffff] border-black text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-gray-500 hover:text-black hover:border-black' }}">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>

                @if(Route::has('admin.analytics'))
                <a href="{{ route('admin.analytics') }}" 
                   class="flex items-center gap-3 p-3 font-black uppercase text-xs tracking-widest transition-all border-2 {{ request()->routeIs('admin.analytics') ? 'bg-[#00ffff] border-black text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-gray-500 hover:text-black hover:border-black' }}">
                    <i class="fas fa-chart-line w-5"></i> Analytics
                </a>
                @endif

                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 p-3 font-black uppercase text-xs tracking-widest transition-all border-2 {{ request()->routeIs('admin.products.index') ? 'bg-[#00ffff] border-black text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-gray-500 hover:text-black hover:border-black' }}">
                    <i class="fas fa-box w-5"></i> Stock Control
                </a>

                @if(Route::has('admin.orders.index'))
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-3 p-3 font-black uppercase text-xs tracking-widest transition-all border-2 {{ request()->routeIs('admin.orders.*') ? 'bg-[#00ffff] border-black text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-gray-500 hover:text-black hover:border-black' }}">
                    <i class="fas fa-receipt w-5"></i> Orders
                </a>
                @endif

                @if(Route::has('admin.users'))
                <a href="{{ route('admin.users') }}" 
                   class="flex items-center gap-3 p-3 font-black uppercase text-xs tracking-widest transition-all border-2 {{ request()->routeIs('admin.users') ? 'bg-[#00ffff] border-black text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-gray-500 hover:text-black hover:border-black' }}">
                    <i class="fas fa-users w-5"></i> User Management
                </a>
                @endif
            </nav>
        </div>

        <div class="p-6 space-y-4">
            <form action="{{ url('/logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white brutalist-button py-2 font-black text-[10px] uppercase tracking-widest">
                    <i class="fas fa-sign-out-alt mr-2"></i> System_Logout
                </button>
            </form>

            <div class="flex items-center gap-2 text-gray-400 font-bold text-[10px] uppercase cursor-pointer hover:text-black">
                <i class="fas fa-cog"></i> Settings
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-64 flex flex-col">
        <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-8 sticky top-0 z-20 select-none">
            <div class="flex items-center gap-8">
                <a href="{{ route('admin.dashboard') }}" class="text-3xl font-black italic tracking-tighter hover:text-cyan-500 transition">SKRIVE</a>
                <nav class="hidden md:flex gap-6 uppercase font-black text-[10px] tracking-widest">
                    <a href="/" class="hover:text-cyan-500 transition">Marketplace</a>
                    <a href="{{ route('admin.products.index') }}" class="hover:text-cyan-500 transition">Components</a>
                    <a href="{{ route('admin.products.index') }}" class="bg-[#00ffff] border-x-4 border-black px-4 py-7 -my-7 flex items-center">Inventory</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-5 font-black">
                <form action="{{ route('admin.products.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="SEARCH_SYSTEM..." 
                           class="border-4 border-black px-4 py-2 text-[10px] w-64 focus:outline-none focus:bg-cyan-50 uppercase">
                    <button type="submit" class="absolute right-4 top-3 text-xs">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <a href="{{ Route::has('admin.orders.index') ? route('admin.orders.index') : '#' }}">
                    <i class="fas fa-shopping-cart cursor-pointer hover:text-cyan-500"></i>
                </a>
                
                <i class="fas fa-user-circle text-xl cursor-pointer hover:text-cyan-500"></i>
            </div>
        </header>

        <div class="p-8 space-y-8">
            <div>
                <div class="flex justify-between items-end">
                    <div>
                        <h2 class="text-5xl font-black tracking-tighter uppercase leading-none">Inventory_Control</h2>
                        <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">Global distribution node: <span class="text-black">SEC_BETA_V4</span></p>
                    </div>
                    <a href="{{ route('admin.products.create') }}" class="bg-[#00ffff] border-4 border-black px-6 py-3 font-black text-xs uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                        <i class="fas fa-plus mr-2"></i> Add New Unit
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-4 border-4 border-black divide-x-4 divide-black bg-white">
                <div class="p-4">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">Total_Units</p>
                    <h3 class="text-3xl font-black italic">{{ $products->count() }}</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Stored_Items</p>
                </div>
                <div class="p-4 bg-red-50/20">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-red-500"><span class="bg-cyan-400 w-2 h-2 inline-block mr-1 border border-black"></span> Low_Stock_Alerts</p>
                    <h3 class="text-3xl font-black italic text-red-600">{{ $products->where('stock', '<=', 10)->count() }}</h3>
                    <p class="text-[8px] font-bold text-red-500 mt-1 uppercase">Critical_Action_Required</p>
                </div>
                <div class="p-4">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400"><span class="border border-black px-1 mr-1 italic">X</span> Safe_Items</p>
                    <h3 class="text-3xl font-black italic">{{ $products->where('stock', '>', 10)->count() }}</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Secure_Stock_Level</p>
                </div>
                <div class="p-4 relative">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400"><i class="fas fa-bolt mr-1"></i> Warehouse_Temp</p>
                    <h3 class="text-3xl font-black italic">18.5°C</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Optimal_Cooling_Active</p>
                    <i class="fas fa-thermometer-half absolute right-4 bottom-4 text-gray-200 text-3xl"></i>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-cyan-100 border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center">
                <p class="text-xs font-black uppercase italic tracking-wider">System_Log: {{ session('success') }}</p>
                <i class="fas fa-check-circle text-black text-sm"></i>
            </div>
            @endif

            <div class="border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] bg-white">
                <div class="bg-black text-white p-4 flex justify-between items-center">
                    <h4 class="font-black text-xs tracking-[0.2em] uppercase italic">Live_Inventory_Data_Stream</h4>
                    <div class="flex gap-2">
                        <button class="border-2 border-white px-3 py-1 text-[8px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition">Filter</button>
                        <button class="border-2 border-white px-3 py-1 text-[8px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition">Export</button>
                    </div>
                </div>
                <table class="w-full text-left bg-white border-collapse">
                    <thead>
                        <tr class="border-b-4 border-black bg-gray-50 text-[9px] font-black uppercase tracking-widest">
                            <th class="p-4 border-r-2 border-black w-32 text-center text-red-500 italic">Item_ID</th>
                            <th class="p-4 border-r-2 border-black">Component_Name</th>
                            <th class="p-4 border-r-2 border-black">Category</th>
                            <th class="p-4 border-r-2 border-black text-center">Stock_Lvl</th>
                            <th class="p-4 border-r-2 border-black text-center">Status_Code</th>
                            <th class="p-4 border-r-2 border-black">Last_Mod</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black text-[10px] font-bold italic uppercase">
                        @foreach($products as $product)
                        <tr class="hover:bg-cyan-50 transition-colors">
                            <td class="p-4 border-r-2 border-black text-center font-black not-italic">#SK-{{ $product->id }}-X</td>
                            <td class="p-4 border-r-2 border-black font-black italic not-italic">{{ $product->name }}</td>
                            <td class="p-4 border-r-2 border-black text-gray-400 not-italic">{{ $product->category }}</td>
                            <td class="p-4 border-r-2 border-black">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 h-4 border-2 border-black bg-white p-0.5 overflow-hidden">
                                        <div class="h-full bg-cyan-400 border-r-2 border-black transition-all" style="width: {{ min(($product->stock / 100) * 100, 100) }}%"></div>
                                    </div>
                                    <span class="font-black not-italic text-xs">{{ $product->stock }}</span>
                                </div>
                            </td>
                            <td class="p-4 border-r-2 border-black text-center">
                                @if($product->stock > 10)
                                    <span class="bg-[#00ffff] border-2 border-black px-2 py-0.5 text-[8px] font-black not-italic shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">STABLE</span>
                                @else
                                    <span class="bg-red-500 text-white border-2 border-black px-2 py-0.5 text-[8px] font-black not-italic shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">LOW_STOCK</span>
                                @endif
                            </td>
                            <td class="p-4 border-r-2 border-black text-gray-400 not-italic">
                                {{ $product->updated_at ? $product->updated_at->format('Y-m-d') : 'N/A' }}
                            </td>
                            <td class="p-4">
                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="hover:text-cyan-500 transition-colors">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari gudang?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-red-500 transition-colors">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-3 gap-8">
                <div class="col-span-2 border-4 border-black p-6 flex justify-between bg-white relative overflow-hidden">
                    <span class="absolute top-0 left-0 bg-black text-white px-2 py-0.5 text-[8px] font-black uppercase italic tracking-widest"><i class="fas fa-terminal"></i> NODE_HARDWARE_METRICS</span>
                    <div class="pt-4">
                        <p class="text-[8px] font-black text-gray-400 uppercase mb-1">Bandwidth</p>
                        <p class="text-xl font-black">1.2 GBPS</p>
                        <div class="w-16 h-1 bg-cyan-400 mt-1 border border-black"></div>
                    </div>
                    <div class="pt-4">
                        <p class="text-[8px] font-black text-gray-400 uppercase mb-1">Latency</p>
                        <p class="text-xl font-black">0.4 MS</p>
                        <div class="w-16 h-1 bg-black mt-1 border border-black"></div>
                    </div>
                    <div class="pt-4">
                        <p class="text-[8px] font-black text-gray-400 uppercase mb-1">Encryption</p>
                        <p class="text-xl font-black">AES-512</p>
                        <div class="w-16 h-1 bg-cyan-400 mt-1 border border-black"></div>
                    </div>
                    <div class="pt-4">
                        <p class="text-[8px] font-black text-gray-400 uppercase mb-1">Backup</p>
                        <p class="text-xl font-black">OFFSITE_ON</p>
                        <div class="w-16 h-1 bg-black mt-1 border border-black"></div>
                    </div>
                </div>
                <div class="bg-black text-white p-6 relative overflow-hidden group cursor-crosshair border-4 border-black">
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=300" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-cyan-400 uppercase tracking-widest italic">Secure_Infrastructure</p>
                        <p class="text-xs font-bold mt-2 leading-tight uppercase">Manual override enabled for local sector controls.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>