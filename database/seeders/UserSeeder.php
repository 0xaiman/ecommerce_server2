<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use function PHPSTORM_META\type;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@fruitmart.local'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'type' => 'admin',
            ]
        );

        // Customer User
        User::firstOrCreate(
            ['email' => 'customer@fruitmart.local'],
            [
                'name' => 'Fruit Customer',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'type' => 'client',
              
            ]
        );
    }
}
