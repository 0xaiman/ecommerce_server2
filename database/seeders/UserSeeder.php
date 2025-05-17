<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'dev@mail.com',
                'name' => 'Developer',
                'password' => 'password',
                'type' => 'dev',
            ],
            [
                'email' => 'admin@mail.com',
                'name' => 'Admin',
                'password' => 'password',
                'type' => 'admin',
            ],
            [
                'email' => 'manager@mail.com',
                'name' => 'Manager',
                'password' => 'password',
                'type' => 'manager',
            ],
            [
                'email' => 'dataentry@mail.com',
                'name' => 'Data Entry',
                'password' => 'password',
                'type' => 'data_entry',
            ],
            [
                'email' => 'customer@mail.com',
                'name' => 'Customer',
                'password' => 'password',
                'type' => 'client',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'email_verified_at' => now(),
                    'type' => $user['type'],
                ]
            );
        }
    }
}
