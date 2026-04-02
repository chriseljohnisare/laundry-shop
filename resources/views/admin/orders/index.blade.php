<x-admin-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Order Management</h2>
            <p class="text-gray-500 font-medium">Track, update, and manage all laundry transactions.</p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all flex items-center">
                <i class="fas fa-file-export mr-2 text-indigo-500"></i> Export Data
            </button>
            <a href="{{ route('admin.orders.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-black text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex items-center">
                <i class="fas fa-plus mr-2"></i> New Order
            </a>
        </div>
    </div>

    <!-- Analytics Quick View -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Total Volume</p>
                <h4 class="text-xl font-black text-gray-900">{{ $orders->total() }}</h4>
            </div>
            <div class="h-10 w-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-receipt"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-yellow-600">Pending Wash</p>
                <h4 class="text-xl font-black text-gray-900">{{ \App\Models\Order::whereIn('status', ['received', 'washing', 'drying', 'folding'])->count() }}</h4>
            </div>
            <div class="h-10 w-10 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-spinner"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-green-600">Ready for Pickup</p>
                <h4 class="text-xl font-black text-gray-900">{{ \App\Models\Order::where('status', 'ready')->count() }}</h4>
            </div>
            <div class="h-10 w-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-box"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-red-600">Unpaid Invoices</p>
                <h4 class="text-xl font-black text-gray-900">{{ \App\Models\Order::get()->filter(fn($o) => $o->payment_status !== 'full')->count() }}</h4>
            </div>
            <div class="h-10 w-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative max-w-sm w-full">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="Search by receipt or customer..." class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border-none rounded-xl text-sm font-bold placeholder-gray-400 focus:ring-2 focus:ring-indigo-500/20 transition-all">
            </div>
            <div class="flex items-center space-x-2">
                <select class="bg-gray-50 border-none text-sm font-bold text-gray-600 rounded-xl focus:ring-indigo-500 py-2.5 pl-4 pr-10">
                    <option value="">All Statuses</option>
                    <option value="received">Received</option>
                    <option value="processing">In Progress</option>
                    <option value="ready">Ready</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/80 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Receipt & Date</th>
                        <th class="px-8 py-5">Customer Details</th>
                        <th class="px-8 py-5">Service Required</th>
                        <th class="px-8 py-5">Production Status</th>
                        <th class="px-8 py-5">Payment</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-5 text-sm">
                                <div class="font-mono font-black text-gray-900 mb-1">#{{ $order->receipt_number }}</div>
                                <div class="text-[11px] font-bold text-gray-400">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500 font-black text-[10px] mr-3">
                                        {{ strtoupper(substr($order->customer->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-gray-900 tracking-tight">{{ $order->customer->name }}</p>
                                        <p class="text-[10px] font-bold text-gray-400">{{ $order->customer->contact_number }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-gray-700">{{ $order->service->name }}</div>
                                <div class="text-xs font-medium text-gray-500">{{ $order->weight_kg }} KG @ ${{ number_format($order->price_per_kg, 2) }}</div>
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $statusConfig = [
                                        'received' => ['color' => 'bg-slate-100 text-slate-600', 'icon' => 'fa-clock'],
                                        'washing' => ['color' => 'bg-blue-100 text-blue-600', 'icon' => 'fa-soap'],
                                        'drying' => ['color' => 'bg-orange-100 text-orange-600', 'icon' => 'fa-wind'],
                                        'folding' => ['color' => 'bg-purple-100 text-purple-600', 'icon' => 'fa-shirt'],
                                        'ready' => ['color' => 'bg-emerald-100 text-emerald-600', 'icon' => 'fa-check-double'],
                                        'completed' => ['color' => 'bg-indigo-100 text-indigo-600', 'icon' => 'fa-box-check'],
                                        'returned' => ['color' => 'bg-red-100 text-red-600', 'icon' => 'fa-undo'],
                                    ];
                                    $conf = $statusConfig[$order->status] ?? ['color' => 'bg-gray-100 text-gray-600', 'icon' => 'fa-info-circle'];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $conf['color'] }}">
                                    <i class="fas {{ $conf['icon'] }} mr-1.5"></i>
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-sm">
                                <div class="font-black text-gray-900 mb-1">${{ number_format($order->total_amount, 2) }}</div>
                                @if($order->payment_status === 'full')
                                    <span class="text-[10px] font-black uppercase tracking-wider text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-md">Paid</span>
                                @elseif($order->payment_status === 'partial')
                                    <span class="text-[10px] font-black uppercase tracking-wider text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded-md">Partial</span>
                                @else
                                    <span class="text-[10px] font-black uppercase tracking-wider text-red-500 bg-red-50 px-2 py-0.5 rounded-md">Unpaid</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="inline-flex rounded-xl bg-gray-50 p-1 border border-gray-100">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="h-8 w-8 flex items-center justify-center rounded-lg text-indigo-600 hover:bg-white hover:shadow-sm transition-all" title="View Details">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                                        <i class="fas fa-receipt text-2xl text-gray-300"></i>
                                    </div>
                                    <h5 class="text-base font-black text-gray-500 mb-1">No orders found.</h5>
                                    <p class="text-sm text-gray-400 font-medium">Create a new order to get started.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-gray-50/30 border-t border-gray-50">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
