<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $revenue = Payment::sum('amount');
        $pendingOrders = Order::whereIn('status', ['received', 'washing', 'drying', 'folding', 'ready'])->count();
        $completedOrders = Order::whereIn('status', ['completed', 'returned'])->count();
        
        $recentOrders = Order::with(['customer', 'service'])
            ->latest()
            ->limit(5)
            ->get();

        // Monthly revenue for the last 6 months
        $monthlyRevenue = Payment::select(
                DB::raw('SUM(amount) as total'),
                DB::raw("DATE_FORMAT(paid_at, '%b %Y') as month")
            )
            ->whereNotNull('paid_at')
            ->groupBy('month')
            ->orderBy('paid_at', 'desc')
            ->limit(6)
            ->get()
            ->reverse();

        $ordersByService = Order::select('services.name', DB::raw('count(*) as count'))
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->groupBy('services.name')
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders', 
            'revenue', 
            'pendingOrders', 
            'completedOrders', 
            'recentOrders',
            'monthlyRevenue',
            'ordersByService'
        ));
    }
}
