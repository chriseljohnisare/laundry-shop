<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function index()
    {
        // 1. Monthly Revenue for the current year
        $monthlyData = Payment::select(
                DB::raw('SUM(amount) as total'),
                DB::raw("DATE_FORMAT(paid_at, '%b') as month"),
                DB::raw("MONTH(paid_at) as month_num")
            )
            ->whereYear('paid_at', date('Y'))
            ->groupBy('month', 'month_num')
            ->orderBy('month_num')
            ->get();

        // 2. Revenue by Service
        $serviceData = Order::select('services.name', DB::raw('SUM(orders.weight_kg * orders.price_per_kg) as total'))
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->groupBy('services.name')
            ->orderBy('total', 'desc')
            ->get();

        // 3. Payment Method Distribution
        $paymentMethods = Payment::select('type', DB::raw('SUM(amount) as total'))
            ->groupBy('type')
            ->get();

        // 4. Top Customers by Spending
        $topCustomers = Customer::select('customers.name', DB::raw('SUM(payments.amount) as total_spent'))
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->join('payments', 'orders.id', '=', 'payments.order_id')
            ->groupBy('customers.id', 'customers.name')
            ->orderBy('total_spent', 'desc')
            ->limit(5)
            ->get();

        // 5. Overall Stats
        $totalRevenue = Payment::sum('amount');
        $averageOrderValue = Order::count() > 0 ? $totalRevenue / Order::count() : 0;
        $thisMonthRevenue = Payment::whereMonth('paid_at', now()->month)->whereYear('paid_at', now()->year)->sum('amount');

        return view('admin.revenue.index', compact(
            'monthlyData',
            'serviceData',
            'paymentMethods',
            'topCustomers',
            'totalRevenue',
            'averageOrderValue',
            'thisMonthRevenue'
        ));
    }
}
