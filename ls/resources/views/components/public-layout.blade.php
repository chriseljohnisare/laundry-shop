<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LaundryPro</title>

    <!-- 1. TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- 2. ALPINE.JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- 3. FONTS & ICONS -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0a0c10; color: white; }
        .hero-bg { background: radial-gradient(circle at 0% 0%, #1e1b4b 0%, #0f172a 100%); }
    </style>
</head>
<body class="antialiased">
    <!-- Nav -->
    <nav class="fixed top-0 w-full z-50 bg-slate-950/80 backdrop-blur-xl border-b border-white/10 h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <div class="bg-indigo-600 p-2 rounded-xl">
                    <i class="fas fa-washing-machine text-white"></i>
                </div>
                <span class="text-xl font-bold">LaundryPro</span>
            </a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#services" class="text-sm font-semibold text-slate-400 hover:text-white transition">Services</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-indigo-600 px-6 py-2 rounded-xl text-sm font-bold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-400">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-slate-950 px-6 py-2 rounded-xl text-sm font-bold">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-slate-950 py-20 border-t border-white/5 text-center">
        <p class="text-slate-500 text-sm font-bold tracking-widest uppercase">&copy; {{ date('Y') }} LaundryPro Global</p>
    </footer>
</body>
</html>
