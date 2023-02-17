<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Rank;

class RankSeeder extends Seeder
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
                'id'                    => Str::orderedUuid(),
                'level'                 => '0',
                'name'                  => 'Contributor',
                'direct_donator'        => '0',
                'must_have_dwline'      => '0',
                'total_team_donator'    => '0',
                'rrank_donation_total'  => '0',
                'rreward'               => '0',
                'rsocial_event'         => '0',
                'is_contributor'        => 1,
                'diff_rate'             => 0,
                'created_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => Str::orderedUuid(),
                'level'                 => '1',
                'name'                  => 'Donator',
                'direct_donator'        => '3',
                'must_have_dwline'      => '0',
                'total_team_donator'    => '10',
                'rrank_donation_total'  => '10000',
                'rreward'               => '250',
                'rsocial_event'         => '0',
                'is_contributor'        => 0,
                'diff_rate'             => 0.05,
                'created_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => Str::orderedUuid(),
                'level'                 => '2',
                'name'                  => 'Coordinator',
                'direct_donator'        => '5',
                'must_have_dwline'      => '8',
                'total_team_donator'    => '100',
                'rrank_donation_total'  => '100000',
                'rreward'               => '2500',
                'rsocial_event'         => '500',
                'is_contributor'        => 0,
                'diff_rate'             => 0.075,
                'created_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => Str::orderedUuid(),
                'level'                 => '3',
                'name'                  => 'Supervisor',
                'direct_donator'        => '10',
                'must_have_dwline'      => '6',
                'total_team_donator'    => '1000',
                'rrank_donation_total'  => '900000',
                'rreward'               => '22500',
                'rsocial_event'         => '4500',
                'is_contributor'        => 0,
                'diff_rate'             => 0.1,
                'created_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => Str::orderedUuid(),
                'level'                 => '4',
                'name'                  => 'Manager',
                'direct_donator'        => '15',
                'must_have_dwline'      => '4',
                'total_team_donator'    => '10000',
                'rrank_donation_total'  => '7500000',
                'rreward'               => '187500',
                'rsocial_event'         => '37500',
                'is_contributor'        => 0,
                'diff_rate'             => 0.125,
                'created_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => Str::orderedUuid(),
                'level'                 => '5',
                'name'                  => 'Director',
                'direct_donator'        => '20',
                'must_have_dwline'      => '2',
                'total_team_donator'    => '100000',
                'rrank_donation_total'  => '50000000',
                'rreward'               => '1250000',
                'rsocial_event'         => '250000',
                'is_contributor'        => 0,
                'diff_rate'             => 0.15,
                'created_at'            => date('Y-m-d H:i:s')
            ],
        ];

        Rank::insert($data);
    }
}
