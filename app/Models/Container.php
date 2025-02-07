<?php

namespace App\Models;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Container extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shipment()
    {
        return $this->belongsToMany(Shipment::class, 'user_shipment_container');
    }

    public function shipment_container()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');    
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingInstructions()
    {
        return $this->hasMany(ShippingInstruction::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
