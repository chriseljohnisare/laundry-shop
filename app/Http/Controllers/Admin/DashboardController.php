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
                \Illuminate\Support\Facades\DB::raw('SUM(amount) as total'),
                \Illuminate\Support\Facades\DB::raw("strftime('%m %Y', paid_at) as month")
            )
            ->whereNotNull('paid_at')
            ->groupBy('month')
            ->orderBy('paid_at', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($item) {
                // Convert back to "Month Year" format for the view
                $item->month = date('M Y', strtotime(substr($item->month, 0, 2) . '/01/' . substr($item->month, 3)));
                return $item;
            })
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
