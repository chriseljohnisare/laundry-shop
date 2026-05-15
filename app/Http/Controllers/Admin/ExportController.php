<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function exportOrders()
    {
        $fileName = 'orders_export_' . date('Y-m-d') . '.csv';
        $orders = Order::with(['customer', 'service'])->latest()->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Receipt #', 'Customer', 'Service', 'Weight (KG)', 'Price/KG', 'Total Amount', 'Status', 'Date'];

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->receipt_number,
                    $order->customer->name ?? 'N/A',
                    $order->service->name ?? 'N/A',
                    $order->weight_kg,
                    $order->price_per_kg,
                    number_format($order->total_amount, 2),
                    ucfirst($order->status),
                    $order->created_at->format('Y-m-d H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportRevenue()
    {
        $fileName = 'revenue_export_' . date('Y-m-d') . '.csv';
        $payments = Payment::with('order.customer')->latest()->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Transaction ID', 'Receipt #', 'Customer', 'Amount', 'Type', 'Status', 'Date'];

        $callback = function() use($payments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->id,
                    $payment->order->receipt_number ?? 'N/A',
                    $payment->order->customer->name ?? 'N/A',
                    number_format($payment->amount, 2),
                    ucfirst($payment->type),
                    ucfirst($payment->status),
                    $payment->paid_at ? $payment->paid_at->format('Y-m-d H:i') : 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
