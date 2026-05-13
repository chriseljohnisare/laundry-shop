<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['receipt_number', 'customer_id', 'service_id', 'weight_kg', 'price_per_kg', 'status', 'notes'])]
class Order extends Model
{
    use LogsActivity;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->weight_kg * $this->price_per_kg;
    }

    public function getPaidAmountAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getPaymentStatusAttribute()
    {
        $total = $this->total_amount;
        $paid = $this->paid_amount;
        if ($paid >= $total) return 'full';
        if ($paid > 0) return 'partial';
        return 'unpaid';
    }
}
