<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User
        User::create([
            "name" => "User",
            'first_name' => 'User',
            'last_name' => 'Classic',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => RoleType::USER,
            'status' => UserStatus::ACTIVE,
        ]);

        // Superadmin User
        User::create([
            'name' => 'Superadmin User',
            'first_name' => 'Superadmin',
            'last_name' => 'User',
            'email' => 'sadmin@gmail.com',
            'password' => Hash::make('1234'),
            'role' => RoleType::SUPERADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        // Admin User
        User::create([
            'name' => 'Admin User',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => RoleType::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
