<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.services.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center mb-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Catalog
        </a>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Service</h2>
        <p class="text-gray-500 font-medium">Update the details for {{ $service->name }}.</p>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.services.update', $service) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="p-8 lg:p-10 space-y-8">
                    <!-- Service Name -->
                    <div>
                        <label for="name" class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Service Identity</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-tag"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required 
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Price per KG -->
                    <div>
                        <label for="price_per_kg" class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Rate per Kilogram ($)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <input type="number" step="0.01" min="0" name="price_per_kg" id="price_per_kg" value="{{ old('price_per_kg', $service->price_per_kg) }}" required 
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        </div>
                        <x-input-error :messages="$errors->get('price_per_kg')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Service Description</label>
                        <textarea name="description" id="description" rows="4" 
                            class="block w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none">{{ old('description', $service->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>
                
                <div class="p-8 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <button type="button" onclick="window.history.back();" class="text-gray-500 font-bold text-sm hover:text-gray-900 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition-all flex items-center">
                        <span>Update Service</span>
                        <i class="fas fa-save ml-3"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
