<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class UserWalletHistory extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'trx_at',
        'trx_id',
        'type',
        'user_id',
        'user_wallet_id',
        'amount',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
