<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class ProqueDifferenceRate extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'queue_id',
        'trx_packages_id',
        'diff_rate_max',
        'is_process'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
