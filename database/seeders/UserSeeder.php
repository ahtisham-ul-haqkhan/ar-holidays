<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'rahman@artravels.com'],
            [
                'name' => 'Rehman Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}

