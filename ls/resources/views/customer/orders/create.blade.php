<x-customer-layout>
    <div class="mb-10">
        <a href="{{ route('customer.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to My Orders
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Schedule New Pickup</h1>
        <p class="text-gray-500 font-medium">Ready for fresh clothes? Tell us what you need.</p>
    </div>

    <div class="max-w-3xl" x-data="{ selectedService: '{{ old('service_id') }}' }">
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
            <form action="{{ route('customer.orders.store') }}" method="POST">
                @csrf
                
                <div class="p-8 lg:p-12 space-y-10">
                    
                    <!-- Service Selection -->
                    <div>
                        <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center">
                            <span class="h-8 w-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center mr-3 text-sm">01</span>
                            Select Cleaning Service
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($services as $service)
                                <label class="cursor-pointer group block" @click="selectedService = '{{ $service->id }}'">
                                    <input type="radio" name="service_id" value="{{ $service->id }}" class="sr-only" required {{ old('service_id') == $service->id ? 'checked' : '' }}>
                                    
                                    <div :class="selectedService == '{{ $service->id }}' ? 'border-indigo-500 bg-white shadow-xl ring-4 ring-indigo-50' : 'border-slate-50 bg-slate-50'" 
                                         class="p-6 rounded-[2rem] border-2 transition-all duration-300 hover:border-indigo-200">
                                        
                                        <div class="flex items-center justify-between mb-4">
                                            <div :class="selectedService == '{{ $service->id }}' ? 'bg-indigo-600 text-white' : 'bg-white text-indigo-600'"
                                                 class="h-10 w-10 rounded-xl flex items-center justify-center shadow-sm transition-colors">
                                                <i class="fas fa-tags text-sm"></i>
                                            </div>
                                            
                                            <!-- Custom Radio UI -->
                                            <div :class="selectedService == '{{ $service->id }}' ? 'border-indigo-500 bg-indigo-500' : 'border-slate-200 bg-white'"
                                                 class="h-5 w-5 rounded-full border-2 flex items-center justify-center transition-colors">
                                                <div class="h-1.5 w-1.5 rounded-full bg-white transition-opacity"
                                                     :class="selectedService == '{{ $service->id }}' ? 'opacity-100' : 'opacity-0'"></div>
                                            </div>
                                        </div>
                                        
                                        <p class="text-sm font-black text-slate-900 mb-1">{{ $service->name }}</p>
                                        <p class="text-xs font-bold text-indigo-600 tracking-tight">${{ number_format($service->price_per_kg, 2) }} / KG</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('service_id')" class="mt-4" />
                    </div>

                    <div class="w-full h-px bg-gray-100"></div>

                    <!-- Instructions -->
                    <div>
                        <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center">
                            <span class="h-8 w-8 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center mr-3 text-sm">02</span>
                            Special Instructions
                        </h3>
                        
                        <div class="relative">
                            <textarea name="notes" rows="4" class="block w-full p-6 bg-gray-50 border-none rounded-[2rem] text-sm font-medium text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none" placeholder="e.g. Please use unscented detergent, extra care for the white shirts..."></textarea>
                        </div>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <!-- Note about weight -->
                    <div class="bg-indigo-50/50 rounded-2xl p-6 flex items-start">
                        <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white shrink-0 mr-4">
                            <i class="fas fa-info text-xs"></i>
                        </div>
                        <p class="text-xs font-bold text-indigo-900/70 leading-relaxed">
                            <span class="text-indigo-900">Note:</span> Your items will be professionally weighed by our courier upon collection. The final price will be updated in your dashboard immediately after weighing.
                        </p>
                    </div>
                    
                </div>
                
                <div class="p-8 lg:px-12 bg-slate-950 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="text-center sm:text-left">
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Pick up scheduled for</p>
                        <p class="text-white font-bold text-sm">Today, within 2 hours</p>
                    </div>
                    <button type="submit" class="w-full sm:w-auto bg-white text-slate-900 px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-200 transition-all shadow-xl active:scale-95">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-customer-layout>
