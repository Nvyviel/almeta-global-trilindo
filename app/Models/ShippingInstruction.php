<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInstruction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
