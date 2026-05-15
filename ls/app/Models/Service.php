<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'price_per_kg', 'description'])]
class Service extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
