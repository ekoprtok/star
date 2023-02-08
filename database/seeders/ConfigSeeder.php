<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'            => Str::orderedUuid(),
                'key'           => 'withdrawal_fee',
                'value'         => '0.36',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => Str::orderedUuid(),
                'key'           => 'donation_rate',
                'value'         => '1.2',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => Str::orderedUuid(),
                'key'           => 'withdrawal_min',
                'value'         => '1.0',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => Str::orderedUuid(),
                'key'           => 'diff_rate_max',
                'value'         => '0.15',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => Str::orderedUuid(),
                'key'           => 'package_redeem_rate',
                'value'         => '40',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => Str::orderedUuid(),
                'key'           => 'kindness_percentage',
                'value'         => '150',
                'created_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'            => Str::orderedUuid(),
                'key'           => 'kindness_gift_percentage',
                'value'         => '50',
                'created_at'    => date('Y-m-d H:i:s')
            ],
        ];

        Config::insert($data);
    }
}