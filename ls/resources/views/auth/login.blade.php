<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-10 text-center lg:text-left">
        <h2 class="text-3xl font-black text-gray-900 tracking-tight mb-2">Welcome Back!</h2>
        <p class="text-gray-500 font-medium">Please enter your details to sign in.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-envelope"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="admin@laundry.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-lock"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label for="remember_me" class="ml-3 block text-sm font-bold text-gray-700">
                Remember my device
            </label>
        </div>

        <div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex justify-center items-center">
                <span>Sign In Securely</span>
                <i class="fas fa-arrow-right ml-3"></i>
            </button>
        </div>
    </form>

    <div class="mt-10 text-center">
        <p class="text-sm font-bold text-gray-500">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 transition font-black">Register now</a>
        </p>
    </div>
</x-guest-layout>
