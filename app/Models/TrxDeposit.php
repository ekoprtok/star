<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class TrxDeposit extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'submitted_at',
        'user_wallet_id',
        'amount',
        'file_path',
        'received_amount',
        'notes',
        'status',
        'responsed_by',
        'responsed_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
