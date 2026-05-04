<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKRIVE - Admin Core</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700;900&display=swap');
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
<body class="bg-white min-h-screen flex selection:bg-[#00ffff] selection:text-black">

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

        <div class="p-10 space-y-10">
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="text-7xl font-black tracking-tighter uppercase leading-none">Inventory_Control</h2>
                    <p class="text-xs font-bold text-gray-400 mt-4 uppercase tracking-[0.3em]">Node: <span class="text-black">SEC_BETA_V4</span> / Protocol: <span class="text-black">Encrypted</span></p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="bg-[#00ffff] brutalist-button px-8 py-4 font-black text-xs uppercase tracking-widest text-center select-none inline-block">
                    <i class="fas fa-plus mr-2"></i> Add New Unit
                </a>
            </div>

            <div class="grid grid-cols-4 border-4 border-black bg-white divide-x-4 divide-black">
                <div class="p-6">
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4">Total_Units</p>
                    <h3 class="text-5xl font-black italic">1,248</h3>
                    <p class="text-[9px] font-bold text-cyan-500 mt-2 uppercase tracking-tighter">+12.4% VS_PREV_MONTH</p>
                </div>
                <div class="p-6 bg-red-50/20">
                    <p class="text-[10px] font-black uppercase tracking-widest text-red-500 mb-4">Low_Stock_Alerts</p>
                    <h3 class="text-5xl font-black italic text-red-600">042</h3>
                    <p class="text-[9px] font-bold text-red-500 mt-2 uppercase">Action_Required_Now</p>
                </div>
                <div class="p-6">
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4">Active_Listings</p>
                    <h3 class="text-5xl font-black italic">98.4%</h3>
                    <p class="text-[9px] font-bold text-gray-600 mt-2 uppercase">Uptime_Synchronized</p>
                </div>
                <div class="p-6 relative">
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4">Warehouse_Temp</p>
                    <h3 class="text-5xl font-black italic">18.5°C</h3>
                    <p class="text-[9px] font-bold text-cyan-500 mt-2 uppercase">Cooling_Optimal</p>
                    <i class="fas fa-bolt absolute right-4 bottom-4 text-gray-100 text-4xl"></i>
                </div>
            </div>

            <div class="brutalist-card bg-white">
                <div class="bg-black text-white p-4 flex justify-between items-center select-none">
                    <h4 class="font-black text-xs tracking-[0.4em] uppercase italic">Live_Inventory_Data_Stream</h4>
                    <div class="flex gap-4">
                        <button class="border-2 border-white px-4 py-1 text-[9px] font-black uppercase hover:bg-white hover:text-black transition">Filter</button>
                        <button class="border-2 border-white px-4 py-1 text-[9px] font-black uppercase hover:bg-white hover:text-black transition">Export</button>
                    </div>
                </div>
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-4 border-black bg-gray-50 text-[10px] font-black uppercase tracking-widest select-none">
                            <th class="p-4 border-r-2 border-black w-32 text-center text-red-500 italic">Item_ID</th>
                            <th class="p-4 border-r-2 border-black">Component_Name</th>
                            <th class="p-4 border-r-2 border-black">Category</th>
                            <th class="p-4 border-r-2 border-black text-center">Stock_Level</th>
                            <th class="p-4 border-r-2 border-black text-center">Status</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black text-[11px] font-bold uppercase italic">
                        <tr class="hover:bg-cyan-50 transition-colors">
                            <td class="p-4 border-r-2 border-black text-center font-black">#SK-9921-X</td>
                            <td class="p-4 border-r-2 border-black font-black not-italic">Neural Processor v8.2</td>
                            <td class="p-4 border-r-2 border-black text-gray-400">Logic Boards</td>
                            <td class="p-4 border-r-2 border-black">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 h-5 border-2 border-black bg-white p-0.5">
                                        <div class="h-full bg-cyan-400 border-r-2 border-black" style="width: 65%"></div>
                                    </div>
                                    <span class="font-black not-italic text-xs">428</span>
                                </div>
                            </td>
                            <td class="p-4 border-r-2 border-black text-center">
                                <span class="bg-[#00ffff] border-2 border-black px-3 py-1 text-[9px] font-black not-italic shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">STABLE</span>
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.products.index') }}" class="hover:text-cyan-500 transition">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-3 gap-10">
                <div class="col-span-2 brutalist-card p-8 bg-white flex justify-between relative overflow-hidden select-none">
                    <div class="absolute top-0 left-0 bg-black text-white px-2 py-0.5 text-[8px] font-black tracking-widest uppercase italic">Node_Hardware_Metrics</div>
                    <div>
                        <p class="text-[8px] font-black text-gray-400 uppercase mb-2">Bandwidth</p>
                        <p class="text-3xl font-black">1.2 GBPS</p>
                        <div class="w-20 h-1.5 bg-cyan-400 mt-2 border border-black"></div>
                    </div>
                    <div>
                        <p class="text-[8px] font-black text-gray-400 uppercase mb-2">Latency</p>
                        <p class="text-3xl font-black">0.4 MS</p>
                        <div class="w-20 h-1.5 bg-black mt-2 border border-black"></div>
                    </div>
                    <div>
                        <p class="text-[8px] font-black text-gray-400 uppercase mb-2">Encryption</p>
                        <p class="text-3xl font-black">AES-512</p>
                        <div class="w-20 h-1.5 bg-cyan-400 mt-2 border border-black"></div>
                    </div>
                </div>
                <div class="brutalist-card bg-black text-white p-6 relative group cursor-crosshair">
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=400" alt="Core Overlay" class="absolute inset-0 w-full h-full object-cover opacity-30 grayscale transition-all duration-500 group-hover:grayscale-0 group-hover:scale-110">
                    <div class="relative z-10 select-none">
                        <p class="text-[10px] font-black text-cyan-400 uppercase tracking-widest italic">Manual_Override_Active</p>
                        <p class="text-xs font-bold mt-2 uppercase leading-tight">Emergency secure protocols enabled for local sector controls.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>