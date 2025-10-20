<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Faisalabad',
                'state_id' => 1
            ],
            [
                'title' => 'Lahore',
                'state_id' => 1
            ],
            [
                'title' => 'Karachi',
                'state_id' => 2
            ],
            [
                'title' => 'Islamabad',
                'state_id' => 5
            ]
        ];

        foreach ($data as $city) {
            $record = City::create($city);
        }
    }
}
