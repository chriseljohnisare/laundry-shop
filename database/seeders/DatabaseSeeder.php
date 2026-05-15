<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@laundry.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_approved' => true,
        ]);

        // Staff
        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@laundry.com',
            'username' => 'staff',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'is_approved' => true,
        ]);

        // Customer User
        $customerUser = User::create([
            'name' => 'John Doe',
            'email' => 'customer@laundry.com',
            'username' => 'customer',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Customer Profile
        Customer::create([
            'user_id' => $customerUser->id,
            'name' => 'John Doe',
            'contact_number' => '09123456789',
            'address' => '123 Main St',
            'email' => 'customer@laundry.com',
        ]);

        // Services
        $services = [
            ['name' => 'Wash & Fold', 'price_per_kg' => 2.50, 'description' => 'Standard washing and folding service.'],
            ['name' => 'Dry Cleaning', 'price_per_kg' => 5.00, 'description' => 'Professional dry cleaning.'],
            ['name' => 'Ironing', 'price_per_kg' => 3.00, 'description' => 'Ironing only service.'],
        ];

        foreach ($services as $svc) {
            Service::create($svc);
        }
    }
}
