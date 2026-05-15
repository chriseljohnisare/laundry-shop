<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.customers.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center mb-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Directory
        </a>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Register New Client</h2>
        <p class="text-gray-500 font-medium">Create a new customer profile and system account.</p>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.customers.store') }}" method="POST">
                @csrf
                
                <div class="p-8 lg:p-12 grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    <!-- Basic Info -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-black text-gray-900 flex items-center">
                            <span class="h-8 w-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center mr-3 text-sm">01</span>
                            Personal Information
                        </h3>
                        
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all"
                                placeholder="Enter full name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Contact Number</label>
                            <input type="text" name="contact_number" value="{{ old('contact_number') }}" required 
                                class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all"
                                placeholder="0912 345 6789">
                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Physical Address</label>
                            <textarea name="address" rows="3" required 
                                class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-medium text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all resize-none"
                                placeholder="Unit, Street, City..."></textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Account Info -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-black text-gray-900 flex items-center">
                            <span class="h-8 w-8 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center mr-3 text-sm">02</span>
                            Security & Account
                        </h3>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all"
                                placeholder="client@example.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Initial Password</label>
                            <input type="password" name="password" required 
                                class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all"
                                placeholder="••••••••">
                            <p class="text-[10px] text-gray-400 mt-2 font-bold italic">Clients can change this after their first login.</p>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>
                </div>
                
                <div class="p-8 lg:px-12 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <button type="button" onclick="window.history.back();" class="text-gray-500 font-bold text-sm hover:text-gray-900 transition-colors">
                        Cancel Registration
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex items-center">
                        <span>Onboard Client</span>
                        <i class="fas fa-user-check ml-3"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
