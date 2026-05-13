<x-guest-layout>
    <div class="mb-8 text-center lg:text-left">
        <h2 class="text-3xl font-black text-gray-900 tracking-tight mb-2">Create Account</h2>
        <p class="text-gray-500 font-medium">Join us today to experience premium laundry care.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="Enter your full name">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-envelope text-sm"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="email@example.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Confirm</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-500" />
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex justify-center items-center">
                <span>Create Account</span>
                <i class="fas fa-arrow-right ml-3"></i>
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <p class="text-sm font-bold text-gray-500">
            Already registered? 
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 transition font-black">Sign in here</a>
        </p>
    </div>
</x-guest-layout>
