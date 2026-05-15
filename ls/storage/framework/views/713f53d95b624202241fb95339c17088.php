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
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Revenue Insights</h2>
            <p class="text-gray-500 font-medium">Financial analytics and performance tracking.</p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()" class="bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all flex items-center">
                <i class="fas fa-print mr-2 text-indigo-500"></i> Print Report
            </button>
        </div>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl shadow-slate-200">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 opacity-10 rounded-full blur-3xl -mr-10 -mt-10"></div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400 mb-2 relative z-10">Total Gross Revenue</p>
            <h3 class="text-4xl font-black mb-4 relative z-10">$<?php echo e(number_format($totalRevenue, 2)); ?></h3>
            <div class="flex items-center text-xs font-bold text-slate-400 relative z-10">
                <span class="text-emerald-400 mr-2"><i class="fas fa-arrow-up mr-1"></i> 12.5%</span> vs last year
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Monthly Performance</p>
            <h3 class="text-4xl font-black text-slate-900 mb-4">$<?php echo e(number_format($thisMonthRevenue, 2)); ?></h3>
            <div class="flex items-center text-xs font-bold text-slate-400">
                <span class="text-indigo-500 mr-2">Target: $5,000.00</span>
                <?php $progress = ($thisMonthRevenue / 5000) * 100; ?>
                <div class="flex-1 h-1.5 bg-slate-100 rounded-full ml-4 overflow-hidden">
                    <div class="h-full bg-indigo-500 rounded-full" style="width: <?php echo e(min(100, $progress)); ?>%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Avg. Ticket Size</p>
            <h3 class="text-4xl font-black text-slate-900 mb-4">$<?php echo e(number_format($averageOrderValue, 2)); ?></h3>
            <div class="flex items-center text-xs font-bold text-slate-400">
                <i class="fas fa-chart-pie mr-2 text-purple-500"></i> Per transaction average
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
            <h4 class="text-xl font-black text-slate-900 mb-10">Revenue Trend (<?php echo e(date('Y')); ?>)</h4>
            <div class="h-[350px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Service Distribution -->
        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm flex flex-col">
            <h4 class="text-xl font-black text-slate-900 mb-10">Service Profitability</h4>
            <div class="flex-1 space-y-8">
                <?php $__currentLoopData = $serviceData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $percentage = $totalRevenue > 0 ? ($service->total / $totalRevenue) * 100 : 0; 
                        $colors = ['bg-indigo-500', 'bg-purple-500', 'bg-emerald-500', 'bg-orange-500'];
                        $color = $colors[$loop->index % count($colors)];
                    ?>
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-black text-slate-700 uppercase tracking-tight"><?php echo e($service->name); ?></span>
                            <span class="text-sm font-black text-slate-900">$<?php echo e(number_format($service->total, 2)); ?></span>
                        </div>
                        <div class="w-full h-3 bg-slate-50 rounded-full overflow-hidden border border-slate-100 p-0.5">
                            <div class="<?php echo e($color); ?> h-full rounded-full transition-all duration-1000" style="width: <?php echo e($percentage); ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Top Customers -->
        <div class="lg:col-span-2 bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
            <h4 class="text-xl font-black text-slate-900 mb-10">VIP Clients (High Spend)</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50 text-slate-400 text-[10px] uppercase font-black tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Client Name</th>
                            <th class="px-6 py-4 text-right">Total Contribution</th>
                            <th class="px-6 py-4 text-right">Loyalty Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php $__currentLoopData = $topCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-5 flex items-center">
                                    <div class="h-10 w-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black text-xs mr-4">
                                        <?php echo e(strtoupper(substr($customer->name, 0, 2))); ?>

                                    </div>
                                    <span class="text-sm font-bold text-slate-700"><?php echo e($customer->name); ?></span>
                                </td>
                                <td class="px-6 py-5 text-right font-black text-slate-900">$<?php echo e(number_format($customer->total_spent, 2)); ?></td>
                                <td class="px-6 py-5 text-right">
                                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase px-3 py-1 rounded-lg">Top Tier</span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="bg-slate-900 rounded-[3rem] p-10 text-white shadow-2xl">
            <h4 class="text-xl font-black mb-10">Payment Channels</h4>
            <div class="space-y-10">
                <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center mr-4">
                                <?php if($pm->type === 'cash'): ?> <i class="fas fa-money-bill-wave text-emerald-400"></i>
                                <?php elseif($pm->type === 'card'): ?> <i class="fas fa-credit-card text-indigo-400"></i>
                                <?php else: ?> <i class="fas fa-wallet text-purple-400"></i> <?php endif; ?>
                            </div>
                            <div>
                                <p class="text-sm font-black uppercase tracking-widest"><?php echo e($pm->type); ?></p>
                                <p class="text-xs text-slate-500 font-bold">Processed Volume</p>
                            </div>
                        </div>
                        <p class="text-xl font-black">$<?php echo e(number_format($pm->total, 2)); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Chart.js Integration -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($monthlyData->pluck('month')); ?>,
                datasets: [{
                    label: 'Revenue ($)',
                    data: <?php echo json_encode($monthlyData->pluck('total')); ?>,
                    borderColor: '#6366f1',
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6366f1',
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(99, 102, 241, 0.05)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#f1f5f9' },
                        ticks: { font: { weight: 'bold', family: 'Plus Jakarta Sans' }, color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold', family: 'Plus Jakarta Sans' }, color: '#94a3b8' }
                    }
                }
            }
        });
    </script>
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
<?php /**PATH C:\a\laundry-shop\laundry-laravel\resources\views/admin/revenue/index.blade.php ENDPATH**/ ?>