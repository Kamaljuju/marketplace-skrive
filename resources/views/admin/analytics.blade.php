<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKRIVE - Analytics & Metrics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <h2 class="text-5xl font-black tracking-tighter uppercase leading-none">System_Analytics</h2>
                        <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">Diagnostic Level: <span class="text-black">SEC_BETA_V4</span></p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 border-4 border-black divide-x-4 divide-black bg-white">
                <div class="p-4">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">Total_Revenue</p>
                    <h3 class="text-3xl font-black italic">IDR {{ number_format($revenue, 0, ',', '.') }}</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Lifetime_Sales</p>
                </div>
                <div class="p-4">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">Conversion_Rate</p>
                    <h3 class="text-3xl font-black italic">{{ $conversionRate }}%</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Order_vs_User_Stream</p>
                </div>
                <div class="p-4">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">Avg_Order_Value</p>
                    <h3 class="text-3xl font-black italic">IDR {{ number_format($avgOrderValue, 0, ',', '.') }}</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Mean_Per_Transaction</p>
                </div>
                <div class="p-4 relative">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">Items_Sold</p>
                    <h3 class="text-3xl font-black italic">{{ $totalItemsSold }}</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Successful_Fulfillments</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-8">
                <div class="col-span-2 border-4 border-black p-6 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] relative">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-black text-xs tracking-widest uppercase italic">Node_Revenue_Time_Stream</h4>
                        <span class="bg-black text-white text-[8px] font-black px-2 py-1 tracking-widest uppercase">Live_Updates</span>
                    </div>
                    <div class="w-full h-72">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="border-4 border-black p-6 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
                    <div>
                        <h4 class="font-black text-xs tracking-widest uppercase italic mb-6">Order_Distributions</h4>
                        <div class="w-full h-56 flex justify-center items-center">
                            <canvas id="orderStatusChart"></canvas>
                        </div>
                    </div>
                    <div class="border-t-2 border-black pt-4 mt-4 grid grid-cols-2 gap-2 text-[10px] font-black uppercase tracking-wider">
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-cyan-400 border border-black inline-block"></span> Completed
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-yellow-300 border border-black inline-block"></span> Pending
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Data Pendapatan Bulanan (Statik / Dinamis dari Backend)
        const monthlyLabels = @json($monthlyLabels);
        const monthlyData = @json($monthlyData);

        // Chart 1: Revenue Time Stream
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'REVENUE_STREAM (IDR)',
                    data: monthlyData,
                    borderColor: '#000000',
                    borderWidth: 4,
                    backgroundColor: '#00ffff',
                    fill: true,
                    tension: 0, 
                    pointBackgroundColor: '#000000',
                    pointBorderColor: '#00ffff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { color: '#e5e5e5' },
                        ticks: { font: { family: 'Space Grotesk', weight: '700' }, color: '#000000' }
                    },
                    y: {
                        grid: { color: '#e5e5e5' },
                        ticks: { font: { family: 'Space Grotesk', weight: '700' }, color: '#000000' }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Data Distribusi Status
        const statusCounts = @json($statusCounts);

        // Chart 2: Order Status Distributions
        const ctxStatus = document.getElementById('orderStatusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    data: statusCounts,
                    backgroundColor: ['#00ffff', '#fde047'],
                    borderColor: '#000000',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>
</html>