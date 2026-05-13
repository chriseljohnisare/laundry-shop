<?php if (isset($component)) { $__componentOriginale0f1cdd055772eb1d4a99981c240763e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f1cdd055772eb1d4a99981c240763e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Executive Dashboard</h2>
            <p class="text-gray-500 font-medium">Real-time operational metrics and business performance.</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all flex items-center">
                <i class="fas fa-calendar-range mr-2 text-indigo-500"></i> Last 30 Days
            </button>
            <a href="<?php echo e(route('admin.orders.create')); ?>" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> New Transaction
            </a>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
        <!-- Total Orders -->
        <div class="bg-white p-7 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fas fa-shopping-basket text-7xl text-indigo-900"></i>
            </div>
            <div class="flex items-center mb-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                    <i class="fas fa-shopping-basket text-xl"></i>
                </div>
                <span class="ml-auto text-green-500 text-xs font-bold bg-green-50 px-2 py-1 rounded-lg">+12%</span>
            </div>
            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Total Bookings</p>
            <h3 class="text-3xl font-black text-gray-900"><?php echo e(number_format($totalOrders)); ?></h3>
        </div>

        <!-- Revenue -->
        <div class="bg-white p-7 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fas fa-wallet text-7xl text-green-900"></i>
            </div>
            <div class="flex items-center mb-4">
                <div class="p-3 bg-green-50 text-green-600 rounded-2xl">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <span class="ml-auto text-green-500 text-xs font-bold bg-green-50 px-2 py-1 rounded-lg">+8.4%</span>
            </div>
            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Gross Revenue</p>
            <h3 class="text-3xl font-black text-gray-900">$<?php echo e(number_format($revenue, 2)); ?></h3>
        </div>

        <!-- Pending -->
        <div class="bg-white p-7 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fas fa-spinner text-7xl text-yellow-900"></i>
            </div>
            <div class="flex items-center mb-4">
                <div class="p-3 bg-yellow-50 text-yellow-600 rounded-2xl">
                    <i class="fas fa-spinner text-xl"></i>
                </div>
                <span class="ml-auto text-yellow-600 text-xs font-bold bg-yellow-50 px-2 py-1 rounded-lg">Active</span>
            </div>
            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">In Progress</p>
            <h3 class="text-3xl font-black text-gray-900"><?php echo e(number_format($pendingOrders)); ?></h3>
        </div>

        <!-- Completed -->
        <div class="bg-white p-7 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fas fa-circle-check text-7xl text-blue-900"></i>
            </div>
            <div class="flex items-center mb-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <i class="fas fa-circle-check text-xl"></i>
                </div>
                <span class="ml-auto text-blue-500 text-xs font-bold bg-blue-50 px-2 py-1 rounded-lg">Success</span>
            </div>
            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Fulfilled</p>
            <h3 class="text-3xl font-black text-gray-900"><?php echo e(number_format($completedOrders)); ?></h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders Table -->
        <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                <h3 class="text-xl font-black text-gray-900">Recent Activity</h3>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-indigo-600 font-bold text-sm hover:text-indigo-800 transition">View Ledger →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Receipt</th>
                            <th class="px-8 py-4">Client</th>
                            <th class="px-8 py-4">Service</th>
                            <th class="px-8 py-4">Current Status</th>
                            <th class="px-8 py-4 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-5">
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-xs font-mono font-bold">#<?php echo e($order->receipt_number); ?></span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-[10px] font-black mr-3">
                                            <?php echo e(strtoupper(substr($order->customer->name, 0, 2))); ?>

                                        </div>
                                        <span class="text-sm font-bold text-gray-700"><?php echo e($order->customer->name); ?></span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm text-gray-500 font-medium"><?php echo e($order->service->name); ?></td>
                                <td class="px-8 py-5">
                                    <?php
                                        $statusConfig = [
                                            'received' => ['color' => 'bg-slate-100 text-slate-600', 'icon' => 'fa-clock'],
                                            'washing' => ['color' => 'bg-blue-100 text-blue-600', 'icon' => 'fa-soap'],
                                            'drying' => ['color' => 'bg-orange-100 text-orange-600', 'icon' => 'fa-wind'],
                                            'folding' => ['color' => 'bg-purple-100 text-purple-600', 'icon' => 'fa-shirt'],
                                            'ready' => ['color' => 'bg-emerald-100 text-emerald-600', 'icon' => 'fa-check'],
                                            'completed' => ['color' => 'bg-indigo-100 text-indigo-600', 'icon' => 'fa-box'],
                                            'returned' => ['color' => 'bg-red-100 text-red-600', 'icon' => 'fa-undo'],
                                        ];
                                        $conf = $statusConfig[$order->status] ?? ['color' => 'bg-gray-100 text-gray-600', 'icon' => 'fa-info-circle'];
                                    ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider <?php echo e($conf['color']); ?>">
                                        <i class="fas <?php echo e($conf['icon']); ?> mr-1.5"></i>
                                        <?php echo e($order->status); ?>

                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right font-black text-gray-900">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-folder-open text-4xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-400 font-bold italic text-sm">Waiting for incoming orders...</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Orders by Service List -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-8 border-b border-gray-50">
                <h3 class="text-xl font-black text-gray-900">Service Mix</h3>
            </div>
            <div class="p-8 flex-1 space-y-8">
                <?php $__currentLoopData = $ordersByService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest"><?php echo e($service->name); ?></span>
                            <span class="text-sm font-black text-gray-900"><?php echo e(number_format($service->count)); ?> ops</span>
                        </div>
                        <?php
                            $percentage = $totalOrders > 0 ? ($service->count / $totalOrders) * 100 : 0;
                            $colors = ['bg-indigo-500', 'bg-emerald-500', 'bg-orange-500', 'bg-purple-500'];
                            $color = $colors[$loop->index % count($colors)];
                        ?>
                        <div class="w-full bg-gray-50 rounded-full h-3 overflow-hidden border border-gray-100">
                            <div class="<?php echo e($color); ?> h-full rounded-full transition-all duration-1000 ease-out" style="width: <?php echo e($percentage); ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <?php if($ordersByService->isEmpty()): ?>
                    <div class="flex flex-col items-center justify-center h-full opacity-20">
                        <i class="fas fa-chart-pie text-6xl mb-4"></i>
                        <p class="text-sm font-bold italic">No distribution data</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="p-8 bg-gray-50 border-t border-gray-100 mt-auto">
                <div class="bg-white rounded-2xl p-4 flex items-center justify-between border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-lightbulb text-yellow-400 mr-3"></i>
                        <span class="text-xs font-bold text-gray-600">Pro Tip: Dry Cleaning leads revenue.</span>
                    </div>
                    <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php /**PATH C:\a\laundry-shop\laundry-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>