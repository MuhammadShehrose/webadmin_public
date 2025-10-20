<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Super Admin',
                'type' => 'admin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => 'password',
            ],
            [
                'name' => 'Brand',
                'type' => 'brand',
                'email' => 'brand@gmail.com',
                'email_verified_at' => now(),
                'password' => 'password',
            ],
            [
                'name' => 'User 1',
                'type' => 'user',
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => 'password',
            ]
        ];

        foreach ($data as $user) {
            $role = $user['type'];
            unset($user['type']);
            $record = User::create($user);
            $record->assignRole($role);
        }
    }
}
