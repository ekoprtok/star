<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class ProqueDifferenceRateDetail extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'proque_id',
        'user_id',
        'rank_id',
        'rate',
        'rdonation',
        'ramount'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
