<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Rank extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'level',
        'name',
        'direct_donator',
        'must_have_dwline',
        'total_team_donator',
        'rrank_donation_total',
        'rreward',
        'rsocial_event',
        'is_contributor',
        'diff_rate'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
