<x-admin-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">System Settings</h2>
            <p class="text-gray-500 font-medium">Configure your laundry shop branding and global parameters.</p>
        </div>
    </div>

    <div class="max-w-4xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 bg-gray-50/30">
                    <h3 class="text-lg font-black text-gray-900 tracking-tight">Shop Branding</h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">This information appears on customer receipts.</p>
                </div>
                
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="shop_name" value="Business Name" class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1" />
                            <x-text-input id="shop_name" name="shop_name" type="text" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500/20" :value="\App\Models\Setting::get('shop_name', 'LaundryPro')" required />
                        </div>
                        <div>
                            <x-input-label for="shop_contact" value="Contact Number" class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1" />
                            <x-text-input id="shop_contact" name="shop_contact" type="text" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500/20" :value="\App\Models\Setting::get('shop_contact', '+1 (555) 000-0000')" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="shop_address" value="Business Address" class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1" />
                        <textarea id="shop_address" name="shop_address" rows="3" class="w-full bg-gray-50 border-none rounded-3xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500/20" required>{{ \App\Models\Setting::get('shop_address', '123 Laundry St, Clean City') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 bg-gray-50/30">
                    <h3 class="text-lg font-black text-gray-900 tracking-tight">Financial Parameters</h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Configure tax rates and currency display.</p>
                </div>
                
                <div class="p-8">
                    <div class="max-w-xs">
                        <x-input-label for="tax_rate" value="Standard Tax Rate (%)" class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1" />
                        <div class="relative">
                            <x-text-input id="tax_rate" name="tax_rate" type="number" step="0.01" class="w-full bg-gray-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500/20" :value="\App\Models\Setting::get('tax_rate', '0.00')" required />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 font-black">%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-sm shadow-xl shadow-slate-200 hover:bg-black hover:-translate-y-1 transition-all">
                    Save Global Settings
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
