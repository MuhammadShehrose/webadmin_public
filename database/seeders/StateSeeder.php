<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Punjab',
                'country_id' => 1
            ],
            [
                'title' => 'Sindh',
                'country_id' => 1
            ],
            [
                'title' => 'KPK',
                'country_id' => 1
            ],
            [
                'title' => 'Balochistan',
                'country_id' => 1
            ],
            [
                'title' => 'Federal',
                'country_id' => 1
            ]
        ];

        foreach ($data as $state) {
            $record = State::create($state);
        }
    }
}
