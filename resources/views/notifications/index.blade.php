<x-customer-layout>
    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Notification Center</h2>
            <p class="text-gray-500 font-bold">Stay updated with your order progress and shop alerts.</p>
        </div>
        <form action="{{ route('notifications.read-all') }}" method="POST">
            @csrf
            <button type="submit" class="bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-2xl font-black text-sm shadow-sm hover:bg-gray-50 transition-all">
                Mark All as Read
            </button>
        </form>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="divide-y divide-gray-50">
            @forelse ($notifications as $notification)
                <div class="p-8 hover:bg-gray-50/50 transition-colors group {{ !$notification->read_at ? 'bg-indigo-50/20' : '' }}">
                    <div class="flex items-start">
                        <div class="h-12 w-12 rounded-2xl flex items-center justify-center shrink-0 mr-6 {{ $notification->type === 'success' ? 'bg-emerald-100 text-emerald-600' : 'bg-indigo-100 text-indigo-600' }}">
                            <i class="fas {{ $notification->type === 'success' ? 'fa-check-circle' : 'fa-info-circle' }} text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-black text-gray-900">{{ $notification->title }}</h3>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $notification->created_at->format('M d, Y • H:i') }}</span>
                            </div>
                            <p class="text-gray-600 font-medium leading-relaxed mb-6">{{ $notification->message }}</p>
                            
                            <div class="flex items-center space-x-4">
                                @if($notification->link)
                                    <a href="{{ route('notifications.read', $notification) }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                        View Details
                                    </a>
                                @endif
                                
                                @if(!$notification->read_at)
                                    <form action="{{ route('notifications.read', $notification) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs font-black text-gray-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">
                                            Dismiss Alert
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-20 text-center">
                    <div class="h-24 w-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="far fa-bell-slash text-gray-200 text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-400 italic">Your inbox is clear!</h4>
                    <p class="text-gray-300 font-bold mt-2 text-sm uppercase tracking-widest">We'll notify you here when your laundry is ready.</p>
                </div>
            @endforelse
        </div>
        
        @if($notifications->hasPages())
            <div class="p-8 bg-gray-50 border-t border-gray-100">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</x-customer-layout>
