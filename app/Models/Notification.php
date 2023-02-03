<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Notification extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'type',
        'message',
        'from_user_id',
        'to_user_id',
        'is_read'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
