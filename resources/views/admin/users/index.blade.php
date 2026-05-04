<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKRIVE - User Management</title>
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
                        <h2 class="text-5xl font-black tracking-tighter uppercase leading-none">User_Management</h2>
                        <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">Global Access Control: <span class="text-black">SEC_BETA_V4</span></p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 border-4 border-black divide-x-4 divide-black bg-white">
                <div class="p-4">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">Total_Users</p>
                    <h3 class="text-3xl font-black italic">{{ $users->count() }}</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Active_Records</p>
                </div>
                <div class="p-4">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">Admin_Roles</p>
                    <h3 class="text-3xl font-black italic">{{ $users->where('role', 'admin')->count() }}</h3>
                    <p class="text-[8px] font-bold text-cyan-500 mt-1 uppercase">Privileged_Access</p>
                </div>
                <div class="p-4 relative">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-4 text-gray-400">User_Roles</p>
                    <h3 class="text-3xl font-black italic">{{ $users->where('role', '!=', 'admin')->count() }}</h3>
                    <p class="text-[8px] font-bold text-gray-500 mt-1 uppercase">Standard_Access</p>
                </div>
            </div>

            <div class="border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] bg-white">
                <div class="bg-black text-white p-4 flex justify-between items-center">
                    <h4 class="font-black text-xs tracking-[0.2em] uppercase italic">Live_User_Data_Stream</h4>
                    <div class="flex gap-2">
                        <button class="border-2 border-white px-3 py-1 text-[8px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition">Filter</button>
                        <button class="border-2 border-white px-3 py-1 text-[8px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition">Export</button>
                    </div>
                </div>
                <table class="w-full text-left bg-white border-collapse">
                    <thead>
                        <tr class="border-b-4 border-black bg-gray-50 text-[9px] font-black uppercase tracking-widest">
                            <th class="p-4 border-r-2 border-black w-32 text-center text-red-500 italic">User_ID</th>
                            <th class="p-4 border-r-2 border-black">Full_Name</th>
                            <th class="p-4 border-r-2 border-black">Email_Address</th>
                            <th class="p-4 border-r-2 border-black text-center">Role_Status</th>
                            <th class="p-4 border-r-2 border-black text-center">Joined_At</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black text-[10px] font-bold italic uppercase">
                        @foreach($users as $user)
                        <tr class="hover:bg-cyan-50 transition-colors">
                            <td class="p-4 border-r-2 border-black text-center font-black not-italic">#USR-{{ $user->id }}</td>
                            <td class="p-4 border-r-2 border-black font-black italic not-italic">{{ $user->name }}</td>
                            <td class="p-4 border-r-2 border-black text-gray-400 not-italic lowercase">{{ $user->email }}</td>
                            <td class="p-4 border-r-2 border-black text-center">
                                @if($user->role === 'admin')
                                    <span class="bg-[#00ffff] border-2 border-black px-2 py-0.5 text-[8px] font-black not-italic shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">ADMIN</span>
                                @else
                                    <span class="bg-white border-2 border-black px-2 py-0.5 text-[8px] font-black not-italic shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">USER</span>
                                @endif
                            </td>
                            <td class="p-4 border-r-2 border-black text-center text-gray-400 not-italic">
                                {{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}
                            </td>
                            <td class="p-4">
                                <div class="flex justify-center gap-4">
                                    <a href="#" class="hover:text-cyan-500 transition-colors">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <a href="#" class="hover:text-red-500 transition-colors">
                                        <i class="fas fa-trash text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>