<?php

namespace App\Models;

use App\Models\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_shipment_container')->withPivot('container_id');
    }

    public function user_order()
    {
        return $this->belongsTo(User::class);
    }

    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    public function shippingInstructions()
    {
        return $this->hasMany(ShippingInstruction::class);
    }
}
