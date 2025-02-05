<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shipments()
    {
        return $this->belongsToMany(Shipment::class, 'user_shipment_container')->withPivot('container_id');
    }

    public function order_ship()
    {
        return $this->hasMany(Shipment::class);
    }

    public function container()
    {
        return $this->hasMany(Container::class);
    }

    public function seal()
    {
        return $this->hasMany(Seal::class);
    }

    public function consignee()
    {
        return $this->hasMany(Consignee::class);
    }

    public function shippingInstruction()
    {
        return $this->hasMany(ShippingInstruction::class);
    }
}
