<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class OwnerWalletRealHistory extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'trx_at',
        'trx_id',
        'trx_user_id',
        'type',
        'owner_wallet_id',
        'amount',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
