<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class TrxSocialEvent extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'submitted_at',
        'event_at',
        'user_id',
        'rank_id',
        'description',
        'file_path',
        'status',
        'responsed_by',
        'responsed_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
