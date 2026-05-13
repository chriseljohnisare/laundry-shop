<x-customer-layout>
    <div class="mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
        <p class="text-lg text-gray-500 font-medium">Here's the latest update on your laundry.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-indigo-400 mb-2">Active Orders</p>
                <h3 class="text-4xl font-black text-gray-900">{{ $activeOrders }}</h3>
            </div>
            <div class="h-16 w-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-spinner fa-spin-pulse"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-purple-400 mb-2">Total Loads</p>
                <h3 class="text-4xl font-black text-gray-900">{{ $totalOrders }}</h3>
            </div>
            <div class="h-16 w-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-shopping-basket"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-emerald-400 mb-2">Lifetime Spent</p>
                <h3 class="text-4xl font-black text-gray-900">${{ number_format($totalSpent, 2) }}</h3>
            </div>
            <div class="h-16 w-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>

    <!-- Active Tracking & Recent Orders -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Recent Orders List -->
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-6 px-2">
                <h2 class="text-2xl font-black text-gray-900">Recent Activity</h2>
                <a href="{{ route('customer.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recentOrders as $order)
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:border-indigo-100 hover:shadow-md transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center">
                            <div class="h-14 w-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl mr-5 flex-shrink-0">
                                @if($order->status === 'completed' || $order->status === 'returned')
                                    <i class="fas fa-check-circle"></i>
                                @else
                                    <i class="fas fa-washing-machine"></i>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <h4 class="text-lg font-black text-gray-900">{{ $order->service->name }}</h4>
                                    <span class="bg-gray-100 text-gray-600 text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded-md">#{{ $order->receipt_number }}</span>
                                </div>
                                <p class="text-sm font-bold text-gray-500">{{ $order->created_at->format('M d, Y') }} &bull; {{ $order->weight_kg }}kg</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between sm:flex-col sm:items-end sm:justify-center gap-2">
                            <p class="text-xl font-black text-gray-900">${{ number_format($order->total_amount, 2) }}</p>
                            
                            @php
                                $statusColors = [
                                    'received' => 'text-slate-600 bg-slate-100',
                                    'washing' => 'text-blue-600 bg-blue-100',
                                    'drying' => 'text-orange-600 bg-orange-100',
                                    'folding' => 'text-purple-600 bg-purple-100',
                                    'ready' => 'text-emerald-600 bg-emerald-100',
                                    'completed' => 'text-indigo-600 bg-indigo-100',
                                    'returned' => 'text-red-600 bg-red-100',
                                ];
                                $color = $statusColors[$order->status] ?? 'text-gray-600 bg-gray-100';
                            @endphp
                            
                            <span class="px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $color }}">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-[2.5rem] shadow-sm border border-dashed border-gray-200 text-center">
                        <div class="h-20 w-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-tshirt text-2xl text-gray-300"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 mb-2">No Orders Yet!</h3>
                        <p class="text-gray-500 font-medium mb-8">Ready to experience premium laundry care?</p>
                        <a href="{{ route('customer.orders.create') }}" class="inline-block bg-indigo-600 text-white px-8 py-3.5 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                            Book a Pickup
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Action / Promo Panel -->
        <div>
            <div class="bg-gradient-to-br from-indigo-900 to-purple-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-2xl shadow-indigo-200/50 h-full flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full blur-3xl -mr-10 -mt-10"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-500 opacity-20 rounded-full blur-3xl -ml-10 -mb-10"></div>
                
                <div class="relative z-10">
                    <div class="inline-block bg-white/20 backdrop-blur-sm border border-white/20 text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-lg mb-6">
                        Premium Member
                    </div>
                    <h3 class="text-3xl font-black mb-4 leading-tight">Need a<br/>Fresh Wash?</h3>
                    <p class="text-indigo-200 font-medium leading-relaxed mb-8">Our couriers are currently in your area. Schedule a pickup within the next hour for same-day processing.</p>
                </div>
                
                <div class="relative z-10">
                    <a href="#" class="block w-full bg-white text-indigo-900 text-center px-6 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-50 hover:shadow-xl transition-all hover:-translate-y-1">
                        Schedule Pickup Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
