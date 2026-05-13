@props(['currentStatus', 'orderId'])

@php
    $steps = [
        'received' => ['label' => 'Received', 'icon' => 'fa-clock', 'desc' => 'Order registered'],
        'washing' => ['label' => 'Washing', 'icon' => 'fa-soap', 'desc' => 'Cleaning in progress'],
        'drying' => ['label' => 'Drying', 'icon' => 'fa-wind', 'desc' => 'Tumble drying'],
        'folding' => ['label' => 'Folding', 'icon' => 'fa-shirt', 'desc' => 'Final packaging'],
        'ready' => ['label' => 'Ready', 'icon' => 'fa-check-double', 'desc' => 'Awaiting pickup'],
    ];

    $statusOrder = array_keys($steps);
    $currentIndex = array_search($currentStatus, $statusOrder);
    if ($currentIndex === false) {
        // Handle 'completed' or 'returned' which might be outside the main production loop
        if ($currentStatus === 'completed') $currentIndex = 5;
        else $currentIndex = -1;
    }
@endphp

<div class="relative py-12">
    <!-- Progress Line -->
    <div class="absolute left-0 top-[2.75rem] w-full h-1 bg-gray-100 rounded-full overflow-hidden">
        <div class="h-full bg-indigo-600 transition-all duration-1000" style="width: {{ $currentIndex >= 0 ? ($currentIndex / (count($steps) - 1)) * 100 : 0 }}%"></div>
    </div>

    <!-- Steps -->
    <div class="relative flex justify-between">
        @foreach ($steps as $status => $data)
            @php
                $stepIndex = array_search($status, $statusOrder);
                $isCompleted = $currentIndex > $stepIndex || $currentStatus === 'completed';
                $isActive = $currentStatus === $status;
                
                // Try to get timestamp from activity logs
                $log = \App\Models\ActivityLog::where('subject_type', 'App\Models\Order')
                    ->where('subject_id', $orderId)
                    ->where('properties->new->status', $status)
                    ->latest()
                    ->first();
                if (!$log && $status === 'received') {
                     $log = \App\Models\Order::find($orderId);
                }
                $time = $log ? ($log->created_at ?? $log->updated_at) : null;
            @endphp

            <div class="flex flex-col items-center group">
                <!-- Icon Circle -->
                <div class="relative z-10 flex items-center justify-center h-12 w-12 rounded-2xl transition-all duration-500 {{ $isCompleted ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : ($isActive ? 'bg-white border-4 border-indigo-600 text-indigo-600 scale-110 shadow-xl' : 'bg-white border-2 border-gray-100 text-gray-300') }}">
                    @if($isCompleted)
                        <i class="fas fa-check text-sm"></i>
                    @else
                        <i class="fas {{ $data['icon'] }} text-sm"></i>
                    @endif
                </div>

                <!-- Label -->
                <div class="mt-4 text-center">
                    <p class="text-[10px] font-black uppercase tracking-widest {{ $isActive ? 'text-indigo-600' : ($isCompleted ? 'text-gray-900' : 'text-gray-400') }}">
                        {{ $data['label'] }}
                    </p>
                    @if($time)
                        <p class="text-[9px] font-bold text-gray-400 mt-1 whitespace-nowrap">
                            {{ $time->format('h:i A') }}
                        </p>
                    @elseif($isActive)
                         <span class="inline-flex h-1.5 w-1.5 rounded-full bg-indigo-600 animate-ping mt-2"></span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
