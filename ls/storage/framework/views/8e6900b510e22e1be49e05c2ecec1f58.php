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
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0">
        <div>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center mb-2">
                <i class="fas fa-arrow-left mr-2"></i> Back to Orders
            </a>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center">
                Order #<?php echo e($order->receipt_number); ?>

                <?php if($order->payment_status === 'full'): ?>
                    <span class="ml-4 text-[10px] font-black uppercase tracking-widest text-emerald-500 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-100"><i class="fas fa-check-circle mr-1"></i> Paid in Full</span>
                <?php else: ?>
                    <span class="ml-4 text-[10px] font-black uppercase tracking-widest text-red-500 bg-red-50 px-3 py-1 rounded-md border border-red-100"><i class="fas fa-exclamation-circle mr-1"></i> Balance Due</span>
                <?php endif; ?>
            </h2>
        </div>
        <div class="flex space-x-3">
            <a href="<?php echo e(route('admin.orders.print', $order)); ?>" class="bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all flex items-center">
                <i class="fas fa-print mr-2 text-indigo-500"></i> Print Receipt
            </a>
            <form action="<?php echo e(route('admin.orders.destroy', $order)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to void this order?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="bg-red-50 text-red-600 px-4 py-2.5 rounded-xl font-bold text-sm hover:bg-red-100 transition-all flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Void Order
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Details & Status -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Status Updater -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                <h3 class="text-lg font-black text-gray-900 mb-6">Production Status</h3>
                
                <form action="<?php echo e(route('admin.orders.status', $order)); ?>" method="POST" class="flex flex-col sm:flex-row gap-4">
                    <?php echo csrf_field(); ?>
                    <div class="flex-1">
                        <select name="status" class="w-full pl-4 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all cursor-pointer appearance-none">
                            <?php $__currentLoopData = ['received', 'washing', 'drying', 'folding', 'ready', 'completed', 'returned']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status); ?>" <?php echo e($order->status === $status ? 'selected' : ''); ?>>
                                    <?php echo e(strtoupper($status)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3.5 rounded-xl font-black text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all flex items-center justify-center whitespace-nowrap">
                        <i class="fas fa-sync-alt mr-2"></i> Update Status
                    </button>
                </form>

                <!-- Status Progress Bar Concept -->
                <div class="mt-8 relative">
                    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-100 -translate-y-1/2 z-0 rounded-full"></div>
                    <?php
                        $statuses = ['received', 'washing', 'drying', 'folding', 'ready', 'completed'];
                        $currentIndex = array_search($order->status, $statuses);
                        if($order->status === 'returned') $currentIndex = 5; // Treat returned as completed path
                    ?>
                    
                    <div class="absolute top-1/2 left-0 h-1 bg-indigo-500 -translate-y-1/2 z-0 rounded-full transition-all duration-1000" style="width: <?php echo e(($currentIndex / 5) * 100); ?>%;"></div>
                    
                    <div class="relative z-10 flex justify-between">
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $isCompleted = $index <= $currentIndex;
                                $isCurrent = $index === $currentIndex;
                            ?>
                            <div class="flex flex-col items-center">
                                <div class="h-6 w-6 rounded-full border-4 flex items-center justify-center bg-white <?php echo e($isCompleted ? 'border-indigo-500' : 'border-gray-200'); ?> <?php echo e($isCurrent ? 'ring-4 ring-indigo-100 shadow-lg scale-125' : ''); ?> transition-all duration-500">
                                    <?php if($isCompleted): ?>
                                        <div class="h-2 w-2 bg-indigo-500 rounded-full"></div>
                                    <?php endif; ?>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-wider mt-3 <?php echo e($isCurrent ? 'text-indigo-600' : ($isCompleted ? 'text-gray-900' : 'text-gray-400')); ?> hidden sm:block">
                                    <?php echo e($status); ?>

                                </span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50">
                    <h3 class="text-lg font-black text-gray-900">Service Details</h3>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Service Type</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e($order->service->name); ?></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Rate</p>
                            <p class="text-lg font-bold text-gray-900">$<?php echo e(number_format($order->price_per_kg, 2)); ?> <span class="text-xs text-gray-500">/ KG</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Measured Weight</p>
                            <form action="<?php echo e(route('admin.orders.weight', $order)); ?>" method="POST" class="flex items-center space-x-2">
                                <?php echo csrf_field(); ?>
                                <div class="relative">
                                    <input type="number" name="weight_kg" step="0.1" min="0.1" value="<?php echo e($order->weight_kg); ?>" 
                                        class="w-24 pl-3 pr-8 py-1 bg-gray-50 border border-gray-200 rounded-lg text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500">
                                    <span class="absolute right-2 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-400">KG</span>
                                </div>
                                <button type="submit" class="p-1.5 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition-all">
                                    <i class="fas fa-check text-xs"></i>
                                </button>
                            </form>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Created At</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($order->created_at->format('F d, Y - h:i A')); ?></p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Special Instructions / Notes</p>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <p class="text-sm text-gray-600 font-medium leading-relaxed"><?php echo e($order->notes ?: 'No special instructions provided by the customer.'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Customer & Financials -->
        <div class="space-y-8">
            
            <!-- Customer Card -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                <h3 class="text-lg font-black text-gray-900 mb-6">Client Profile</h3>
                <div class="flex items-center mb-6">
                    <div class="h-14 w-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 font-black text-lg mr-4">
                        <?php echo e(strtoupper(substr($order->customer->name, 0, 2))); ?>

                    </div>
                    <div>
                        <p class="text-base font-black text-gray-900"><?php echo e($order->customer->name); ?></p>
                        <a href="<?php echo e(route('admin.customers.edit', $order->customer)); ?>" class="text-xs font-bold text-indigo-500 hover:text-indigo-700 transition-colors">View Full Profile <i class="fas fa-angle-right ml-1"></i></a>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="mt-1 flex-shrink-0 w-8 text-center text-gray-400"><i class="fas fa-phone text-xs"></i></div>
                        <p class="text-sm font-bold text-gray-700"><?php echo e($order->customer->contact_number); ?></p>
                    </div>
                    <div class="flex items-start">
                        <div class="mt-1 flex-shrink-0 w-8 text-center text-gray-400"><i class="fas fa-envelope text-xs"></i></div>
                        <p class="text-sm font-bold text-gray-700"><?php echo e($order->customer->email ?? 'N/A'); ?></p>
                    </div>
                    <div class="flex items-start">
                        <div class="mt-1 flex-shrink-0 w-8 text-center text-gray-400"><i class="fas fa-map-marker-alt text-xs"></i></div>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed"><?php echo e($order->customer->address); ?></p>
                    </div>
                </div>
            </div>

            <!-- Financial Ledger -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 bg-gray-900 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    <h3 class="text-lg font-black mb-6 relative z-10">Invoice Summary</h3>
                    
                    <div class="flex justify-between items-center mb-2 relative z-10">
                        <span class="text-sm text-gray-400 font-medium">Subtotal (<?php echo e($order->weight_kg); ?>kg &times; $<?php echo e(number_format($order->price_per_kg, 2)); ?>)</span>
                        <span class="text-sm font-bold text-white">$<?php echo e(number_format($order->total_amount, 2)); ?></span>
                    </div>
                    <div class="flex justify-between items-center mb-6 relative z-10">
                        <span class="text-sm text-gray-400 font-medium">Tax / Fees</span>
                        <span class="text-sm font-bold text-white">$0.00</span>
                    </div>
                    <div class="w-full h-px bg-gray-700 mb-6 relative z-10"></div>
                    <div class="flex justify-between items-center relative z-10">
                        <span class="text-base font-black text-gray-200 uppercase tracking-widest">Total Due</span>
                        <span class="text-3xl font-black text-white">$<?php echo e(number_format($order->total_amount, 2)); ?></span>
                    </div>
                </div>

                <div class="p-8 border-t border-gray-100 bg-gray-50/50">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-xs font-black uppercase tracking-widest text-gray-500">Amount Paid</span>
                        <span class="text-lg font-black text-emerald-600">$<?php echo e(number_format($order->paid_amount, 2)); ?></span>
                    </div>
                    
                    <?php $balance = $order->total_amount - $order->paid_amount; ?>
                    
                    <div class="flex justify-between items-center mb-8">
                        <span class="text-xs font-black uppercase tracking-widest text-gray-500">Balance Remaining</span>
                        <span class="text-xl font-black <?php echo e($balance > 0 ? 'text-red-600' : 'text-gray-400'); ?>">$<?php echo e(number_format(max(0, $balance), 2)); ?></span>
                    </div>

                    <?php if($balance > 0): ?>
                        <form action="<?php echo e(route('admin.orders.payment', $order)); ?>" method="POST" class="space-y-4">
                            <?php echo csrf_field(); ?>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Record Payment</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-400 font-bold">$</span>
                                    </div>
                                    <input type="number" step="0.01" max="<?php echo e($balance); ?>" name="amount" value="<?php echo e(number_format($balance, 2, '.', '')); ?>" class="block w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="cash" class="peer sr-only" checked>
                                    <div class="text-center p-3 rounded-xl border border-gray-200 bg-white text-xs font-bold text-gray-600 peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:text-indigo-700 transition-all">
                                        <i class="fas fa-money-bill-wave mb-1 block"></i> Cash
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="card" class="peer sr-only">
                                    <div class="text-center p-3 rounded-xl border border-gray-200 bg-white text-xs font-bold text-gray-600 peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:text-indigo-700 transition-all">
                                        <i class="fas fa-credit-card mb-1 block"></i> Card / Transfer
                                    </div>
                                </label>
                            </div>
                            <button type="submit" class="w-full bg-gray-900 text-white py-3.5 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-lg">
                                Process Payment
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 text-center">
                            <i class="fas fa-check-circle text-emerald-500 text-2xl mb-2"></i>
                            <p class="text-sm font-black text-emerald-700">Account Settled</p>
                        </div>
                    <?php endif; ?>
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
<?php /**PATH C:\a\laundry-shop\laundry-laravel\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>