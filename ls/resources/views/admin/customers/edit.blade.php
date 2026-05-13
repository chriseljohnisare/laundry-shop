<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.customers.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center mb-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Directory
        </a>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Client Profile</h2>
        <p class="text-gray-500 font-medium">Updating information for {{ $customer->name }}.</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="p-8 lg:p-10 space-y-8">
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $customer->name) }}" required 
                            class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $customer->email) }}" required 
                            class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Contact Number</label>
                        <input type="text" name="contact_number" value="{{ old('contact_number', $customer->contact_number) }}" required 
                            class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all">
                        <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Physical Address</label>
                        <textarea name="address" rows="3" required 
                            class="block w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-medium text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all resize-none">{{ old('address', $customer->address) }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                </div>
                
                <div class="p-8 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <button type="button" onclick="window.history.back();" class="text-gray-500 font-bold text-sm hover:text-gray-900 transition-colors">
                        Cancel Changes
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition-all flex items-center">
                        <span>Save Updates</span>
                        <i class="fas fa-check ml-3"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
