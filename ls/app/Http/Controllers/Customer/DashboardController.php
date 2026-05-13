<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = auth()->user()->customer;
        
        if (!$customer) {
            // Handle edge case where a user has the 'customer' role but no profile created yet
            return view('customer.dashboard', [
                'totalOrders' => 0,
                'activeOrders' => 0,
                'totalSpent' => 0,
                'recentOrders' => collect()
            ]);
        }

        $totalOrders = $customer->orders()->count();
        $activeOrders = $customer->orders()->whereIn('status', ['received', 'washing', 'drying', 'folding', 'ready'])->count();
        
        $totalSpent = 0;
        foreach($customer->orders as $order) {
            $totalSpent += $order->paid_amount;
        }

        $recentOrders = $customer->orders()->with('service')->latest()->limit(3)->get();

        return view('customer.dashboard', compact('totalOrders', 'activeOrders', 'totalSpent', 'recentOrders'));
    }
}
