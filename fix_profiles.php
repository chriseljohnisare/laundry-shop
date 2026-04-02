<?php
use App\Models\User;
use App\Models\Customer;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = User::where('role', 'customer')->get();
$fixed = 0;

foreach ($users as $user) {
    if (!$user->customer) {
        Customer::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'contact_number' => 'Pending-' . $user->id,
            'address' => 'Pending update',
        ]);
        $fixed++;
    }
}

echo "Fixed $fixed customer profiles.\n";
