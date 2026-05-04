<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKRIVE - Admin Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700;900&display=swap');
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
            <div>
                <h2 class="text-7xl font-black tracking-tighter uppercase leading-none">Order_Stream</h2>
                <p class="text-xs font-bold text-gray-400 mt-4 uppercase tracking-[0.3em]">Node: <span class="text-black">SEC_BETA_V4</span> / Context: <span class="text-black">Transactions</span></p>
            </div>

            @if(session('success'))
                <div class="border-4 border-black p-4 bg-green-100 font-black uppercase tracking-widest text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    {{ session('success') }}
                </div>
            @endif

            <div class="brutalist-card bg-white">
                <div class="bg-black text-white p-4 flex justify-between items-center select-none">
                    <h4 class="font-black text-xs tracking-[0.4em] uppercase italic">Incoming_Orders_Data</h4>
                    <span class="text-cyan-400 text-xs font-black">{{ $orders->count() }} Total Records</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-4 border-black bg-gray-50 text-[10px] font-black uppercase tracking-widest select-none">
                                <th class="p-4 border-r-2 border-black w-32 text-center text-red-500 italic">Order_ID</th>
                                <th class="p-4 border-r-2 border-black">Customer_Name</th>
                                <th class="p-4 border-r-2 border-black">Ordered_Product</th>
                                <th class="p-4 border-r-2 border-black text-center">Amount</th>
                                <th class="p-4 border-r-2 border-black text-center">Status</th>
                                <th class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-black text-[11px] font-bold uppercase italic">
                            @forelse($orders as $order)
                                <tr class="hover:bg-cyan-50 transition-colors">
                                    <td class="p-4 border-r-2 border-black text-center font-black">#ORD-{{ $order->id }}</td>
                                    <td class="p-4 border-r-2 border-black font-black not-italic">{{ $order->user->name ?? 'Unknown' }}</td>
                                    <td class="p-4 border-r-2 border-black text-gray-500 font-bold not-italic">
                                        {{ $order->product->name ?? 'Deleted_Product' }}
                                    </td>
                                    <td class="p-4 border-r-2 border-black text-center font-black not-italic">
                                        Rp {{ number_format($order->total_price ?? ($order->price * $order->quantity), 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 border-r-2 border-black text-center">
                                        @if($order->status == 'completed' || $order->status == 'success')
                                            <span class="bg-green-300 border-2 border-black px-3 py-1 text-[9px] font-black not-italic shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] uppercase">Paid</span>
                                        @elseif($order->status == 'pending')
                                            <span class="bg-[#00ffff] border-2 border-black px-3 py-1 text-[9px] font-black not-italic shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] uppercase">Pending</span>
                                        @elseif($order->status == 'processing')
                                            <span class="bg-yellow-300 border-2 border-black px-3 py-1 text-[9px] font-black not-italic shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] uppercase">Processing</span>
                                        @else
                                            <span class="bg-red-400 border-2 border-black px-3 py-1 text-[9px] font-black not-italic shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] uppercase">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        @if(Route::has('admin.orders.updateStatus'))
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()" class="border-2 border-black text-[9px] font-black px-2 py-1 bg-white hover:bg-black hover:text-white transition cursor-pointer outline-none">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ $order->status == 'completed' || $order->status == 'success' ? 'selected' : '' }}>Paid / Completed</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                            </select>
                                        </form>
                                        @else
                                            <span class="text-[9px] font-black text-gray-400">NO_ROUTE_FOUND</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-xs font-black text-gray-500 uppercase">
                                        No incoming orders data streams available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>