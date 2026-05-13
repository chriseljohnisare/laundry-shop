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
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Client Directory</h2>
            <p class="text-gray-500 font-medium">Manage and monitor your laundry customer database.</p>
        </div>
        <a href="<?php echo e(route('admin.customers.create')); ?>" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-black text-sm shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Register New Client
        </a>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Active Database</p>
            <h4 class="text-2xl font-black text-gray-900"><?php echo e(number_format($totalCustomers)); ?> <span class="text-sm font-bold text-gray-400 ml-1">Total Users</span></h4>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">New This Month</p>
            <h4 class="text-2xl font-black text-green-500">+<?php echo e($newThisMonth); ?> <span class="text-sm font-bold text-gray-400 ml-1">New Registrations</span></h4>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Retention Rate</p>
            <h4 class="text-2xl font-black text-indigo-500"><?php echo e($retentionRate); ?>% <span class="text-sm font-bold text-gray-400 ml-1">Loyalty Score</span></h4>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="<?php echo e(route('admin.customers.index')); ?>" method="GET" class="relative max-w-xs w-full">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Filter by name or email..." class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-2xl text-sm font-bold placeholder-gray-400 focus:ring-2 focus:ring-indigo-500/20 transition-all">
            </form>
            <div class="flex items-center space-x-2">
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="p-3 bg-gray-50 rounded-xl text-gray-400 hover:text-indigo-600 transition-colors"><i class="fas fa-sync-alt"></i></a>
                <button class="p-3 bg-gray-50 rounded-xl text-gray-400 hover:text-indigo-600 transition-colors"><i class="fas fa-filter"></i></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Profile & Name</th>
                        <th class="px-8 py-5">Contact Access</th>
                        <th class="px-8 py-5">Location / Address</th>
                        <th class="px-8 py-5">Onboarding Date</th>
                        <th class="px-8 py-5 text-right">Admin Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-gradient-to-tr from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center text-slate-500 font-black text-sm shadow-inner group-hover:from-indigo-100 group-hover:to-indigo-200 group-hover:text-indigo-600 transition-all duration-300">
                                        <?php echo e(strtoupper(substr($customer->name, 0, 2))); ?>

                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-black text-gray-900 tracking-tight"><?php echo e($customer->name); ?></p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID: #CST-<?php echo e(str_pad($customer->id, 4, '0', STR_PAD_LEFT)); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="space-y-1">
                                    <p class="text-sm font-bold text-gray-700 flex items-center">
                                        <i class="fas fa-envelope text-[10px] text-gray-300 mr-2"></i> <?php echo e($customer->email); ?>

                                    </p>
                                    <p class="text-[11px] font-black text-indigo-500">
                                        <i class="fas fa-phone text-[10px] text-indigo-300 mr-2"></i> <?php echo e($customer->contact_number); ?>

                                    </p>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm text-gray-500 font-medium max-w-[200px] truncate"><?php echo e($customer->address); ?></p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-gray-400"><?php echo e($customer->created_at->format('d M Y')); ?></span>
                            </td>
                            <td class="px-8 py-6 text-right space-x-2">
                                <div class="inline-flex rounded-xl bg-gray-50 p-1 border border-gray-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="<?php echo e(route('admin.customers.edit', $customer)); ?>" class="h-9 w-9 flex items-center justify-center rounded-lg text-gray-400 hover:bg-white hover:text-indigo-600 hover:shadow-sm transition-all">
                                        <i class="fas fa-pen-nib text-xs"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.customers.destroy', $customer)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="h-9 w-9 flex items-center justify-center rounded-lg text-gray-400 hover:bg-white hover:text-red-500 hover:shadow-sm transition-all" onclick="return confirm('Archive this client profile?')">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-20 w-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-users-slash text-2xl text-gray-200"></i>
                                    </div>
                                    <h5 class="text-lg font-black text-gray-400 italic">No customers found.</h5>
                                    <p class="text-gray-300 text-sm mt-2">Try adjusting your search or add a new client.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-8 bg-gray-50/50 border-t border-gray-100">
            <?php echo e($customers->links()); ?>

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
<?php /**PATH C:\a\laundry-shop\laundry-laravel\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>