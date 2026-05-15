<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $customer = auth()->user()->customer;
        
        if (!$customer) {
            return redirect()->route('customer.dashboard')->with('error', 'Please complete your profile to view orders.');
        }

        $orders = $customer->orders()->with('service')->latest()->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }

    public function create()
    {
        $services = \App\Models\Service::orderBy('name')->get();
        return view('customer.orders.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'notes' => 'nullable|string',
        ]);

        $customer = auth()->user()->customer;
        $service = \App\Models\Service::find($request->service_id);

        $order = Order::create([
            'receipt_number' => strtoupper(\Illuminate\Support\Str::random(8)),
            'customer_id' => $customer->id,
            'service_id' => $request->service_id,
            'weight_kg' => 0, // Admin will weigh it upon pickup
            'price_per_kg' => $service->price_per_kg,
            'status' => 'received',
            'notes' => $request->notes,
        ]);

        return redirect()->route('customer.orders.show', $order)->with('success', 'Pickup scheduled successfully! Our courier will contact you shortly.');
    }

    public function show(Order $order)
    {
        $customer = auth()->user()->customer;
        
        if (!$customer || $order->customer_id !== $customer->id) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load(['service', 'payments']);
        return view('customer.orders.show', compact('order'));
    }
}
