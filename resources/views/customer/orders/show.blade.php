<x-customer-layout>
    <div class="mb-10">
        <a href="{{ route('customer.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Back to My Orders
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Order #{{ $order->receipt_number }}</h1>
            <span class="inline-flex items-center self-start bg-indigo-50 text-indigo-600 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-indigo-100">
                <i class="fas fa-calendar-alt mr-2"></i> {{ $order->created_at->format('M d, Y') }}
            </span>
        </div>
    </div>

    <!-- Live Tracker -->
    <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 mb-8 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 opacity-50 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <h3 class="text-xl font-black text-gray-900 mb-4 relative z-10">Live Tracker</h3>
        
        <div class="relative z-10">
            <x-order-stepper :currentStatus="$order->status" :orderId="$order->id" />
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Order Summary -->
        <div class="lg:col-span-2 bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-gray-100">
            <h3 class="text-xl font-black text-gray-900 mb-8">Order Details</h3>
            
            <div class="bg-gray-50 rounded-3xl p-6 md:p-8 border border-gray-100 mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Service Selection</p>
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-white rounded-xl flex items-center justify-center text-indigo-600 shadow-sm mr-4">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div>
                                <p class="text-base font-black text-gray-900">{{ $order->service->name }}</p>
                                <p class="text-xs font-bold text-gray-500">${{ number_format($order->price_per_kg, 2) }} / kg</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total Weight</p>
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-white rounded-xl flex items-center justify-center text-purple-600 shadow-sm mr-4">
                                <i class="fas fa-weight-hanging"></i>
                            </div>
                            <p class="text-xl font-black text-gray-900">{{ $order->weight_kg }} <span class="text-sm text-gray-500 font-bold">KG</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Special Instructions</p>
                @if($order->notes)
                    <div class="bg-yellow-50/50 border border-yellow-100 rounded-2xl p-5">
                        <div class="flex items-start">
                            <i class="fas fa-comment-dots text-yellow-500 mt-1 mr-3"></i>
                            <p class="text-sm font-medium text-gray-700 leading-relaxed">{{ $order->notes }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-sm font-medium text-gray-400 italic">No special instructions provided.</p>
                @endif
            </div>
        </div>

        <!-- Receipt / Financials -->
        <div class="bg-gray-900 rounded-[2.5rem] shadow-2xl p-8 md:p-10 text-white relative overflow-hidden flex flex-col h-full">
            <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-500 opacity-20 rounded-full blur-3xl -mr-10 -mt-10"></div>
            
            <div class="relative z-10 flex-1">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-xl font-black text-white">Receipt</h3>
                    <a href="{{ route('admin.orders.print', $order) }}" class="h-10 w-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors">
                        <i class="fas fa-print text-indigo-400"></i>
                    </a>
                </div>
                
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center text-sm font-medium text-gray-300 border-b border-gray-800 pb-4">
                        <span>Cleaning Service</span>
                        <span class="text-white">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-medium text-gray-300 border-b border-gray-800 pb-4">
                        <span>Delivery Fee</span>
                        <span class="text-white">Free</span>
                    </div>
                </div>
                
                <div class="flex justify-between items-end mb-10">
                    <span class="text-xs font-black uppercase tracking-widest text-indigo-400">Total</span>
                    <span class="text-4xl font-black text-white">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            <div class="relative z-10 bg-white/10 rounded-3xl p-6 border border-white/10 mt-auto">
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Payment Status</p>
                @if($order->payment_status === 'full')
                    <div class="flex items-center text-emerald-400">
                        <i class="fas fa-check-circle text-lg mr-2"></i>
                        <span class="text-sm font-black uppercase tracking-wider">Paid in Full</span>
                    </div>
                @else
                    <div class="flex items-center text-yellow-400 mb-4">
                        <i class="fas fa-exclamation-circle text-lg mr-2"></i>
                        <span class="text-sm font-black uppercase tracking-wider">Balance Due: ${{ number_format($order->total_amount - $order->paid_amount, 2) }}</span>
                    </div>
                    <button class="w-full bg-indigo-600 text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-500 transition-colors">
                        Pay Now Online
                    </button>
                @endif
            </div>
        </div>
    </div>
</x-customer-layout>
