<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaundryPro') }} - Authentication</title>

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
        .auth-bg {
            background-color: #0f172a;
            background-image: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent 40%),
                              radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.15), transparent 40%);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 h-screen flex overflow-hidden">

    <!-- Left Side: Branding / Info (Hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 auth-bg relative items-center justify-center p-12">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="relative z-10 max-w-lg text-white">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 mb-12">
                <div class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center shadow-2xl transform -rotate-6">
                    <i class="fas fa-washing-machine text-indigo-600 text-2xl"></i>
                </div>
                <span class="text-3xl font-extrabold tracking-tight text-white">Laundry<span class="text-indigo-400">Pro</span></span>
            </a>
            
            <h1 class="text-5xl font-black mb-6 leading-tight">Effortless Care for Your Wardrobe.</h1>
            <p class="text-lg text-indigo-100/80 mb-12 leading-relaxed">Join thousands who trust us with their premium garments. Fast, reliable, and trackable laundry services at your fingertips.</p>
            
            <div class="flex items-center space-x-4">
                <div class="flex -space-x-4">
                    <div class="h-12 w-12 rounded-full border-2 border-[#0f172a] bg-indigo-500"></div>
                    <div class="h-12 w-12 rounded-full border-2 border-[#0f172a] bg-purple-500"></div>
                    <div class="h-12 w-12 rounded-full border-2 border-[#0f172a] bg-emerald-500"></div>
                </div>
                <p class="text-sm font-bold text-indigo-200">Over <span class="text-white">10,000+</span> active users</p>
            </div>
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-24 overflow-y-auto bg-white">
        <div class="w-full max-w-md">
            <!-- Mobile Brand -->
            <div class="lg:hidden text-center mb-10">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-3">
                    <div class="h-12 w-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg transform -rotate-6">
                        <i class="fas fa-washing-machine text-white text-2xl"></i>
                    </div>
                    <span class="text-3xl font-extrabold tracking-tight text-gray-900">Laundry<span class="text-indigo-600">Pro</span></span>
                </a>
            </div>

            {{ $slot }}

            <div class="mt-12 text-center text-sm text-gray-500 font-medium">
                &copy; {{ date('Y') }} LaundryPro Global. All rights reserved.
            </div>
        </div>
    </div>

</body>
</html>
