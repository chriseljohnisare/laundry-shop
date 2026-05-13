<?php if (isset($component)) { $__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.public-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('public-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden hero-gradient">
        <!-- Background Orbs -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-indigo-600/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/5 border border-white/10 text-indigo-400 text-xs font-black uppercase tracking-widest mb-10">
                        <span class="flex h-2 w-2 mr-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        Trusted by 5,000+ Professionals
                    </div>
                    <h1 class="text-6xl lg:text-8xl font-black text-white leading-[0.9] mb-10 tracking-tighter">
                        Laundry <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Perfected.</span>
                    </h1>
                    <p class="text-xl text-slate-400 mb-12 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Experience the gold standard in garment care. We combine artisan cleaning techniques with digital convenience.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                        <a href="<?php echo e(route('register')); ?>" class="btn-primary w-full sm:w-auto text-center">
                            Start My First Order
                        </a>
                        <a href="<?php echo e(route('login')); ?>" class="btn-secondary w-full sm:w-auto text-center">
                            Track Shipment
                        </a>
                    </div>
                </div>

                <div class="relative hidden lg:block animate-float">
                    <!-- Premium Glass Card -->
                    <div class="bg-white/5 backdrop-blur-3xl border border-white/10 p-12 rounded-[3.5rem] shadow-2xl">
                        <div class="flex items-center justify-between mb-12">
                            <div class="h-14 w-14 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/40">
                                <i class="fas fa-soap text-white text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Current Status</p>
                                <p class="text-white font-bold">Deep Cleaning...</p>
                            </div>
                        </div>
                        
                        <div class="space-y-8">
                            <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 w-[65%] rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)]"></div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-white/5 p-5 rounded-3xl border border-white/5">
                                    <p class="text-[10px] font-black text-indigo-400 uppercase mb-2">Service</p>
                                    <p class="text-sm font-bold text-white">Silk Preservation</p>
                                </div>
                                <div class="bg-white/5 p-5 rounded-3xl border border-white/5">
                                    <p class="text-[10px] font-black text-purple-400 uppercase mb-2">ETA</p>
                                    <p class="text-sm font-bold text-white">Today, 4PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section id="services" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-24">
                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-indigo-600 mb-4">The Catalog</h2>
                <h3 class="text-4xl lg:text-6xl font-black text-slate-900 tracking-tighter">Bespoke Fabric Care.</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="card-modern group">
                    <div class="h-16 w-16 bg-slate-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl mb-10 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">Elite Wash & Fold</h4>
                    <p class="text-slate-500 font-medium leading-relaxed mb-10">Temperature-controlled cleaning with pH-balanced detergents for daily essentials.</p>
                    <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                        <span class="text-3xl font-black text-slate-900">$2.50<span class="text-sm text-slate-400 ml-1">/kg</span></span>
                        <i class="fas fa-arrow-right text-slate-300 group-hover:text-indigo-600 transition-colors"></i>
                    </div>
                </div>

                <div class="card-modern group scale-105 border-indigo-100 shadow-indigo-100/20">
                    <div class="h-16 w-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-2xl mb-10">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">Luxury Dry Clean</h4>
                    <p class="text-slate-500 font-medium leading-relaxed mb-10">Eco-safe solvents tailored for delicate couture, suits, and evening wear.</p>
                    <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                        <span class="text-3xl font-black text-slate-900">$5.00<span class="text-sm text-slate-400 ml-1">/kg</span></span>
                        <i class="fas fa-arrow-right text-indigo-600"></i>
                    </div>
                </div>

                <div class="card-modern group">
                    <div class="h-16 w-16 bg-slate-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl mb-10 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-wind"></i>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">Pressing & Steam</h4>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">Pressing & Steam</h4>
                    <p class="text-slate-500 font-medium leading-relaxed mb-10">Industrial-grade steaming to remove every crease and refresh fabric fibers.</p>
                    <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                        <span class="text-3xl font-black text-slate-900">$3.00<span class="text-sm text-slate-400 ml-1">/kg</span></span>
                        <i class="fas fa-arrow-right text-slate-300 group-hover:text-indigo-600 transition-colors"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section id="process" class="py-32 bg-slate-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                <div>
                    <h2 class="text-xs font-black uppercase tracking-[0.3em] text-indigo-400 mb-6">The Workflow</h2>
                    <h3 class="text-5xl lg:text-7xl font-black text-white tracking-tighter mb-12 leading-tight">Your weekend, <br/>reclaimed.</h3>
                    
                    <div class="space-y-12">
                        <div class="flex items-start">
                            <div class="h-12 w-12 rounded-full border border-indigo-500/30 flex items-center justify-center text-indigo-400 font-black shrink-0 mr-6">01</div>
                            <div>
                                <h5 class="text-xl font-bold text-white mb-2">Digital Booking</h5>
                                <p class="text-slate-400 font-medium">Select your services and schedule a pickup in seconds through our portal.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="h-12 w-12 rounded-full border border-indigo-500/30 flex items-center justify-center text-indigo-400 font-black shrink-0 mr-6">02</div>
                            <div>
                                <h5 class="text-xl font-bold text-white mb-2">Valet Collection</h5>
                                <p class="text-slate-400 font-medium">Our professional couriers collect your garments safely from your doorstep.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="h-12 w-12 rounded-full border border-indigo-500/30 flex items-center justify-center text-indigo-400 font-black shrink-0 mr-6">03</div>
                            <div>
                                <h5 class="text-xl font-bold text-white mb-2">Premium Delivery</h5>
                                <p class="text-slate-400 font-medium">Receive your items perfectly cleaned, folded, and ready for your wardrobe.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="aspect-square bg-indigo-600/10 rounded-[4rem] border border-white/5 flex items-center justify-center">
                        <i class="fas fa-truck-fast text-[150px] text-indigo-500/20"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b)): ?>
<?php $attributes = $__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b; ?>
<?php unset($__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b)): ?>
<?php $component = $__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b; ?>
<?php unset($__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b); ?>
<?php endif; ?>
<?php /**PATH C:\a\ls\ls\resources\views/home.blade.php ENDPATH**/ ?>