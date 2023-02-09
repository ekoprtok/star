<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Package;

class PackageSeeder extends Seeder
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
                'id'                => Str::orderedUuid(),
                'name'              => 'Regular',
                'level'             => '1',
                'rvalue'            => '110',
                'rdonation'         => '100',
                'rjoin_fee'         => '10',
                'rdaily_blessing'   => '0.135',
                'img_url'           => null,
                'gen_deep'          => 3,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => '1'
            ],
            [
                'id'                => Str::orderedUuid(),
                'name'              => 'Advance',
                'level'             => '2',
                'rvalue'            => '1100',
                'rdonation'         => '1000',
                'rjoin_fee'         => '100',
                'rdaily_blessing'   => '8.5',
                'img_url'           => null,
                'gen_deep'          => 5,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => '1'
            ],
            [
                'id'                => Str::orderedUuid(),
                'name'              => 'Premium',
                'level'             => '3',
                'rvalue'            => '10750',
                'rdonation'         => '10000',
                'rjoin_fee'         => '750',
                'rdaily_blessing'   => '22.5',
                'img_url'           => null,
                'gen_deep'          => 7,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => '1'
            ],
            [
                'id'                => Str::orderedUuid(),
                'name'              => 'Solitaire',
                'level'             => '4',
                'rvalue'            => '105000',
                'rdonation'         => '100000',
                'rjoin_fee'         => '5000',
                'rdaily_blessing'   => '275',
                'gen_deep'          => 9,
                'img_url'           => null,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => '1'
            ],
        ];

        Package::insert($data);
    }
}
