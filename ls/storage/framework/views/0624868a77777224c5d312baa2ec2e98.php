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
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Service Catalog</h2>
            <p class="text-gray-500 font-medium">Define and manage your professional laundry offerings.</p>
        </div>
        <a href="<?php echo e(route('admin.services.create')); ?>" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-black text-sm shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all flex items-center">
            <i class="fas fa-sparkles mr-2"></i> Add New Service
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-indigo-100/50 transition-all duration-500 group relative overflow-hidden">
                <div class="absolute -top-10 -right-10 h-32 w-32 bg-indigo-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="flex justify-between items-start mb-8 relative z-10">
                    <div class="h-16 w-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="flex space-x-2">
                        <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="h-10 w-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-white hover:text-indigo-600 hover:shadow-md transition-all">
                            <i class="fas fa-edit text-sm"></i>
                        </a>
                        <form action="<?php echo e(route('admin.services.destroy', $service)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="h-10 w-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-white hover:text-red-500 hover:shadow-md transition-all" onclick="return confirm('Remove this service from catalog?')">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-black text-gray-900 mb-2"><?php echo e($service->name); ?></h3>
                    <p class="text-gray-500 text-sm font-medium leading-relaxed mb-8 line-clamp-2"><?php echo e($service->description ?? 'No description provided for this service.'); ?></p>
                    
                    <div class="pt-6 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Price Point</p>
                            <p class="text-2xl font-black text-indigo-600">$<?php echo e(number_format($service->price_per_kg, 2)); ?><span class="text-xs text-gray-400 ml-1">/KG</span></p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Orders</p>
                            <p class="text-sm font-black text-gray-900"><?php echo e($service->orders_count ?? 0); ?> Completed</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full bg-white rounded-[2.5rem] p-20 text-center border border-dashed border-gray-200">
                <div class="h-20 w-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-layer-group text-2xl text-gray-200"></i>
                </div>
                <h5 class="text-xl font-black text-gray-400">Your service catalog is empty.</h5>
                <p class="text-gray-300 text-sm mt-2">Create your first service to start accepting orders.</p>
                <a href="<?php echo e(route('admin.services.create')); ?>" class="inline-block mt-8 bg-indigo-600 text-white px-8 py-3 rounded-2xl font-black text-sm hover:bg-indigo-700 transition-all">
                    Create First Service
                </a>
            </div>
        <?php endif; ?>
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
<?php /**PATH C:\a\laundry-shop\laundry-laravel\resources\views/admin/services/index.blade.php ENDPATH**/ ?>