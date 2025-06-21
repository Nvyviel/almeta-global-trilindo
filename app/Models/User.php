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
     * Boot method to automatically generate user_id
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->user_id)) {
                $user->user_id = self::generateRandomUserId();
            }
        });
    }

    public static function generateRandomUserId()
    {
        do {
            $userId = mt_rand(10000000, 99999999);
        } while (self::where('user_id', $userId)->exists());

        return $userId;
    }

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
