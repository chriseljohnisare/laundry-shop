<?php
use App\Models\Customer;
use App\Models\Service;
use App\Models\Order;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$customer = Customer::first();
$service = Service::first();

if ($customer && $service) {
    $order = Order::create([
        'receipt_number' => 'DYNAMIC-99',
        'customer_id' => $customer->id,
        'service_id' => $service->id,
        'weight_kg' => 12.5,
        'price_per_kg' => $service->price_per_kg,
        'status' => 'washing',
        'notes' => 'This is a dynamic test entry.'
    ]);
    echo "SUCCESS: Order #{$order->receipt_number} created dynamically in database.\n";
} else {
    echo "ERROR: Data missing for test.\n";
}
