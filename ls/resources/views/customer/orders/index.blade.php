<x-customer-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">My Orders</h1>
            <p class="text-gray-500 font-medium">View your entire transaction history and track active loads.</p>
        </div>
        <a href="{{ route('customer.orders.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all inline-block text-center">
            Book New Pickup
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
        <!-- Filters -->
        <div class="p-8 border-b border-gray-50 flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex space-x-2 w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
                <a href="#" class="bg-gray-900 text-white px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest whitespace-nowrap">All Orders</a>
                <a href="#" class="bg-gray-50 text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-colors whitespace-nowrap">Active</a>
                <a href="#" class="bg-gray-50 text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-colors whitespace-nowrap">Completed</a>
            </div>
            <div class="relative w-full sm:max-w-xs">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="Search receipt..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-none rounded-xl text-sm font-bold placeholder-gray-400 focus:ring-2 focus:ring-indigo-500/20 transition-all">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Order Info</th>
                        <th class="px-8 py-5">Service Required</th>
                        <th class="px-8 py-5">Current Status</th>
                        <th class="px-8 py-5">Total Cost</th>
                        <th class="px-8 py-5 text-right">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400 font-black text-lg mr-4 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-gray-900 font-mono tracking-tight">#{{ $order->receipt_number }}</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-gray-900 mb-1">{{ $order->service->name }}</p>
                                <p class="text-xs font-medium text-gray-500">{{ $order->weight_kg }}kg load</p>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $statusColors = [
                                        'received' => 'text-slate-600 bg-slate-100 border-slate-200',
                                        'washing' => 'text-blue-600 bg-blue-100 border-blue-200',
                                        'drying' => 'text-orange-600 bg-orange-100 border-orange-200',
                                        'folding' => 'text-purple-600 bg-purple-100 border-purple-200',
                                        'ready' => 'text-emerald-600 bg-emerald-100 border-emerald-200',
                                        'completed' => 'text-indigo-600 bg-indigo-100 border-indigo-200',
                                        'returned' => 'text-red-600 bg-red-100 border-red-200',
                                    ];
                                    $color = $statusColors[$order->status] ?? 'text-gray-600 bg-gray-100 border-gray-200';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl border text-[10px] font-black uppercase tracking-wider {{ $color }}">
                                    @if(in_array($order->status, ['received', 'washing', 'drying', 'folding']))
                                        <span class="h-1.5 w-1.5 rounded-full bg-current mr-2 animate-pulse"></span>
                                    @endif
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-lg font-black text-gray-900">${{ number_format($order->total_amount, 2) }}</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('customer.orders.show', $order) }}" class="inline-flex items-center justify-center h-10 w-10 bg-gray-50 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-20 w-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-box-open text-2xl text-gray-300"></i>
                                    </div>
                                    <h5 class="text-xl font-black text-gray-400 italic">No order history found.</h5>
                                    <p class="text-gray-300 text-sm mt-2">When you place an order, it will appear here.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 bg-gray-50/50 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>
</x-customer-layout>
