<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateIdSeal()
    {
        $letter = "S";
        $numbers = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        return $letter . '' . $numbers;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
