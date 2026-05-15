<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center mb-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Orders
        </a>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create New Transaction</h2>
        <p class="text-gray-500 font-medium">Record a new incoming laundry order.</p>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                
                <div class="p-8 lg:p-12 space-y-10">
                    
                    <!-- Client Selection -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-black text-gray-900">1. Client Selection</h3>
                            <a href="{{ route('admin.customers.create') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-3 py-1.5 rounded-lg transition-colors">
                                + New Client
                            </a>
                        </div>
                        
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <select name="customer_id" required class="block w-full pl-11 pr-10 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none transition-all cursor-pointer">
                                <option value="" disabled selected>Search and select a client...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->contact_number }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                    </div>

                    <div class="w-full h-px bg-gray-100"></div>

                    <!-- Service Details -->
                    <div>
                        <h3 class="text-lg font-black text-gray-900 mb-6">2. Service Details</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Service Type</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-tshirt text-gray-400"></i>
                                    </div>
                                    <select name="service_id" required class="block w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none transition-all cursor-pointer">
                                        <option value="" disabled selected>Select service category</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }} (${{ number_format($service->price_per_kg, 2) }}/kg)
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Measured Weight (KG)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-weight-hanging text-gray-400"></i>
                                    </div>
                                    <input type="number" name="weight_kg" value="{{ old('weight_kg') }}" step="0.1" min="0.1" required class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="0.0">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-gray-400 font-bold text-xs">KG</span>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('weight_kg')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="w-full h-px bg-gray-100"></div>

                    <!-- Special Instructions -->
                    <div>
                        <h3 class="text-lg font-black text-gray-900 mb-4">3. Special Instructions</h3>
                        <div class="relative">
                            <textarea name="notes" rows="3" class="block w-full p-4 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none" placeholder="Any specific folding preferences, stain treatments, or delivery notes?">{{ old('notes') }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                    
                </div>
                
                <div class="p-8 lg:px-12 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <button type="button" onclick="window.history.back();" class="text-gray-500 font-bold text-sm hover:text-gray-900 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex items-center">
                        <span>Generate Order</span>
                        <i class="fas fa-arrow-right ml-3"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
