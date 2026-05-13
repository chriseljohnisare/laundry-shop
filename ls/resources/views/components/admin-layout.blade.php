<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaundryShop Admin') }}</title>

    <!-- 1. TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- 2. ALPINE.JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- 3. FONTS & ICONS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .sidebar-gradient {
            background: #0f172a;
        }

        .nav-link-active {
            background: rgba(79, 70, 229, 0.1);
            color: #818cf8 !important;
            box-shadow: inset 4px 0 0 #6366f1;
        }

        .nav-link-active i {
            color: #818cf8 !important;
            filter: drop-shadow(0 0 8px rgba(99, 102, 241, 0.6));
        }

        .nav-link:hover:not(.nav-link-active) {
            background: rgba(255, 255, 255, 0.03);
            color: #f8fafc;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="font-sans antialiased bg-[#f1f5f9] text-[#1e293b]">
    <div class="min-h-screen flex">
        <!-- Modern Sidebar Restored -->
        <aside class="w-80 sidebar-gradient text-slate-400 hidden lg:flex flex-col sticky top-0 h-screen border-r border-slate-800">
            <!-- Brand -->
            <div class="p-10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4">
                    <div class="h-11 w-11 bg-gradient-to-tr from-indigo-600 to-indigo-400 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/30 transform -rotate-6">
                        <i class="fas fa-washing-machine text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold text-white tracking-tight">Laundry<span class="text-indigo-400">Pro</span></span>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 leading-none mt-1">Admin Terminal</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-6 space-y-1.5 overflow-y-auto custom-scrollbar">
                <div class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.3em] text-slate-600">Main Operations</div>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'nav-link-active' : '' }}">
                    <i class="fas fa-grid-2 w-6 text-lg transition-transform group-hover:scale-110"></i>
                    <span class="font-bold ml-3 text-sm tracking-tight">Executive Dashboard</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="nav-link flex items-center px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.orders.*') ? 'nav-link-active' : '' }}">
                    <i class="fas fa-receipt w-6 text-lg transition-transform group-hover:scale-110"></i>
                    <span class="font-bold ml-3 text-sm tracking-tight">Order Management</span>
                    @php $pendingCount = \App\Models\Order::where('status', 'received')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="ml-auto bg-indigo-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-lg shadow-indigo-500/40">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.customers.index') }}" class="nav-link flex items-center px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.customers.*') ? 'nav-link-active' : '' }}">
                    <i class="fas fa-user-group w-6 text-lg transition-transform group-hover:scale-110"></i>
                    <span class="font-bold ml-3 text-sm tracking-tight">Client Directory</span>
                </a>

                <div class="px-4 py-8 text-[10px] font-black uppercase tracking-[0.3em] text-slate-600">System Controls</div>

                <a href="{{ route('admin.revenue.index') }}" class="nav-link flex items-center px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.revenue.*') ? 'nav-link-active' : '' }}">
                    <i class="fas fa-chart-line w-6 text-lg transition-transform group-hover:scale-110"></i>
                    <span class="font-bold ml-3 text-sm tracking-tight">Revenue Insights</span>
                </a>

                <a href="{{ route('admin.services.index') }}" class="nav-link flex items-center px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.services.*') ? 'nav-link-active' : '' }}">
                    <i class="fas fa-sparkles w-6 text-lg transition-transform group-hover:scale-110"></i>
                    <span class="font-bold ml-3 text-sm tracking-tight">Service Catalog</span>
                </a>
            </nav>

            <!-- Bottom Profile Card -->
            <div class="p-6 m-6 rounded-[2rem] bg-slate-800/40 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="relative">
                        <div class="h-12 w-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white font-black text-lg shadow-xl">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 h-4 w-4 bg-green-500 border-4 border-[#141d2e] rounded-full"></div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-black text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Super Admin</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group flex items-center justify-center space-x-2 py-3 rounded-xl bg-slate-700/50 text-slate-300 hover:bg-red-500 transition-all duration-500 font-black text-[11px] uppercase tracking-widest">
                        <i class="fas fa-power-off group-hover:rotate-90 transition-transform duration-500"></i>
                        <span>Terminate Session</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Glass Header -->
            <header class="h-24 bg-white/70 backdrop-blur-xl border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-40">
                <div class="flex items-center lg:hidden">
                    <button class="p-3 bg-white shadow-sm border border-slate-200 rounded-xl text-slate-600">
                        <i class="fas fa-bars-staggered fa-lg"></i>
                    </button>
                </div>
                
                <div class="flex-1 max-w-xl">
                    <div class="group relative hidden md:block">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-search text-sm"></i>
                        </div>
                        <input type="text" placeholder="Search orders, customers, or receipts..." class="block w-full pl-12 pr-4 py-3 border-none bg-slate-100/50 rounded-2xl text-sm font-medium placeholder-slate-400 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300">
                    </div>
                </div>

                <div class="flex items-center space-x-8">
                    <div class="hidden sm:flex items-center space-x-2">
                        <div class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Node-01 Active</span>
                    </div>
                    
                    <button class="h-12 w-12 bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all relative">
                        <i class="far fa-bell fa-lg"></i>
                        <span class="absolute top-3 right-3 h-2 w-2 bg-indigo-500 rounded-full border-2 border-white"></span>
                    </button>

                    <div class="h-10 w-px bg-slate-200"></div>
                    
                    <button class="h-12 w-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-slate-200 transition-transform hover:scale-105 active:scale-95">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="p-10 custom-scrollbar overflow-y-auto">
                @if (session('success'))
                    <div class="mb-10 animate-fade-in">
                        <div class="bg-indigo-600 rounded-3xl p-5 shadow-2xl shadow-indigo-200 flex items-center text-white">
                            <div class="bg-white/20 h-10 w-10 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="font-bold tracking-tight">{{ session('success') }}</span>
                            <button class="ml-auto opacity-50 hover:opacity-100" onclick="this.parentElement.parentElement.remove()"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                @endif
                
                <div class="max-w-[1600px] mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
