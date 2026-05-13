<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaundryPro') }} - My Account</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <!-- Direct Tailwind CDN for instant results -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js for interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
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
    </style>
</head>
<body class="font-sans antialiased bg-[#f4f7fb] text-gray-900">
    <!-- Top Navigation -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-black text-gray-900 flex items-center tracking-tighter">
                        <div class="bg-indigo-600 p-2 rounded-xl mr-3 shadow-lg shadow-indigo-200">
                            <i class="fas fa-washing-machine text-white text-base"></i>
                        </div>
                        Laundry<span class="text-indigo-600">Pro</span>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('customer.dashboard') }}" class="text-sm font-bold transition-colors {{ request()->routeIs('customer.dashboard') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">Dashboard</a>
                    <a href="{{ route('customer.orders.index') }}" class="text-sm font-bold transition-colors {{ request()->routeIs('customer.orders.*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">My Orders</a>
                    
                    <!-- Notifications -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="h-10 w-10 bg-gray-50 border border-gray-100 rounded-xl text-gray-400 hover:text-indigo-600 hover:border-indigo-100 transition-all relative">
                            <i class="far fa-bell"></i>
                            @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                            @if($unreadCount > 0)
                                <span class="absolute top-2 right-2 h-2 w-2 bg-rose-500 rounded-full border-2 border-white animate-pulse"></span>
                            @endif
                        </button>

                        <!-- Notification Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="absolute right-0 mt-4 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50">
                            <div class="p-4 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                                <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-widest">Notifications</h3>
                                @if($unreadCount > 0)
                                    <form action="{{ route('notifications.read-all') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-[9px] font-black text-indigo-500 hover:text-indigo-700 uppercase tracking-widest transition-colors">Clear All</button>
                                    </form>
                                @endif
                            </div>
                            <div class="max-h-[350px] overflow-y-auto custom-scrollbar">
                                @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                                    <div class="p-4 border-b border-gray-50 hover:bg-gray-50 transition-colors {{ !$notification->read_at ? 'bg-indigo-50/30' : '' }}">
                                        <div class="flex items-start">
                                            <div class="h-7 w-7 rounded-lg flex items-center justify-center shrink-0 mr-3 {{ $notification->type === 'success' ? 'bg-emerald-100 text-emerald-600' : 'bg-indigo-100 text-indigo-600' }}">
                                                <i class="fas {{ $notification->type === 'success' ? 'fa-check-circle' : 'fa-info-circle' }} text-[10px]"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[10px] font-black text-gray-900 mb-0.5">{{ $notification->title }}</p>
                                                <p class="text-[11px] text-gray-500 leading-tight mb-1">{{ $notification->message }}</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-[8px] font-bold text-gray-300 uppercase">{{ $notification->created_at->diffForHumans() }}</span>
                                                    @if(!$notification->read_at)
                                                        <form action="{{ route('notifications.read', $notification) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="text-[8px] font-black text-indigo-500 uppercase tracking-widest">Read</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-8 text-center">
                                        <p class="text-[10px] font-bold text-gray-400 italic">No alerts</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="h-6 w-px bg-gray-200"></div>

                    <!-- Profile Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-3 text-sm font-bold text-gray-700 hover:text-indigo-600 transition-colors focus:outline-none">
                            <div class="h-10 w-10 bg-gradient-to-tr from-indigo-100 to-indigo-200 text-indigo-600 rounded-full flex items-center justify-center font-black shadow-inner">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl shadow-gray-200 border border-gray-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-bold text-gray-700 hover:bg-gray-50 hover:text-indigo-600">Account Settings</a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm font-bold text-red-600 hover:bg-red-50">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-8 animate-fade-in">
                    <div class="bg-indigo-600 rounded-2xl p-4 shadow-xl shadow-indigo-200 flex items-center text-white">
                        <div class="bg-white/20 h-10 w-10 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="font-bold tracking-tight">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>

</body>
</html>
