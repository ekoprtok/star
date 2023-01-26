<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxIntTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'submitted_at',
        'user_wallet_id',
        'amount',
        'to_wallet_id',
        'file_path',
        'status',
        'responsed_by',
        'responsed_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
