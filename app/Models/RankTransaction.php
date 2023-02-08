<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class RankTransaction extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'user_id',
        'parent_id',
        'rank_id',
        'direct_donator',
        'must_have_dwline',
        'total_team_donator',
        'rrank_donation_total',
        'rreward',
        'rsocial_event',
        'res_direct_donator',
        'res_must_have_dwline',
        'res_total_team_donator',
        'res_rrank_donation_total',
        'res_rreward',
        'res_rsocial_event',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
