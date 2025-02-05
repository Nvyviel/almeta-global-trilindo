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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consignee()
    {
        return $this->belongsTo(Consignee::class);
    }
}
