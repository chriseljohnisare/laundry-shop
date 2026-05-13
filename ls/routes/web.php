<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CustomerController as AdminCustomer;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\ServiceController as AdminService;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\OrderController as CustomerOrder;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Default dashboard route that redirects based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin() || $user->isStaff()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin & Staff Routes
Route::middleware(['auth', 'role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    Route::resource('customers', AdminCustomer::class);
    Route::resource('orders', AdminOrder::class);
    Route::resource('services', AdminService::class);
    Route::get('revenue', [\App\Http\Controllers\Admin\RevenueController::class, 'index'])->name('revenue.index');
    
    Route::post('orders/{order}/status', [AdminOrder::class, 'updateStatus'])->name('orders.status');
    Route::post('orders/{order}/weight', [AdminOrder::class, 'updateWeight'])->name('orders.weight');
    Route::get('orders/{order}/print', [AdminOrder::class, 'print'])->name('orders.print');
    Route::post('orders/{order}/payment', [AdminOrder::class, 'addPayment'])->name('orders.payment');
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');
    Route::resource('orders', CustomerOrder::class)->only(['index', 'show', 'create', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
