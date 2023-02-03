<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Package extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'name',
        'level',
        'rvalue',
        'rdonation',
        'rjoin_fee',
        'rdaily_blessing',
        'img_url',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
