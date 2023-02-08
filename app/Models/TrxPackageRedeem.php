<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class TrxPackageRedeem extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'submitted_at',
        'user_id',
        'package_id',
        'package_type',
        'kindeness_percen',
        'rdonation',
        'redeem_rate',
        'ramount',
        'status',
        'responsed_by',
        'responsed_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
