<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'service'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        return view('admin.orders.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'weight_kg' => 'required|numeric|min:0.1',
            'notes' => 'nullable|string',
        ]);

        $service = Service::find($request->service_id);

        $order = Order::create([
            'receipt_number' => strtoupper(Str::random(8)),
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'weight_kg' => $request->weight_kg,
            'price_per_kg' => $service->price_per_kg,
            'status' => 'received',
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'service', 'payments']);
        return view('admin.orders.show', compact('order'));
    }

    public function print(Order $order)
    {
        $order->load(['customer', 'service', 'payments']);
        return view('admin.orders.print', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:received,washing,drying,folding,ready,completed,returned',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully.');
    }

    public function updateWeight(Request $request, Order $order)
    {
        $request->validate([
            'weight_kg' => 'required|numeric|min:0.1',
        ]);

        $order->update([
            'weight_kg' => $request->weight_kg
        ]);

        return back()->with('success', 'Order weight updated. Invoice has been recalculated.');
    }

    public function addPayment(Request $request, Order $order)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:cash,card,ewallet',
        ]);

        Payment::create([
            'order_id' => $order->id,
            'amount' => $request->amount,
            'type' => $request->type,
            'status' => 'full', // Assuming full for now as per simplicity, can be partial
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Payment added successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
