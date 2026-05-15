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
                    
                    <div class="h-6 w-px bg-gray-200"></div>

                    <!-- Profile Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-3 text-sm font-bold text-gray-700 hover:text-indigo-600 transition-colors focus:outline-none">
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-xl object-cover border-2 border-white shadow-md">
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
