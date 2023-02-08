<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class OwnerWallet extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'user_id',
        'rbalance_amount',
        'rbalance_amount_real',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
