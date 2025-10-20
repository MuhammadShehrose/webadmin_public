<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Pakistan',
            ],
            [
                'title' => 'Iran',
                'is_active' => false
            ]
        ];

        foreach ($data as $country) {
            $record = Country::create($country);
        }
    }
}
