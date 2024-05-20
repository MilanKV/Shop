<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
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
            "name" => "Robb",
            'first_name' => 'Robert',
            'last_name' => 'Bond',
            'email' => 'bond@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => Hash::make('12345678'),
            'role' => RoleType::USER,
            'status' => UserStatus::ACTIVE,
        ]);

        // Superadmin User
        User::create([
            'name' => 'Stefo',
            'first_name' => 'Stefan',
            'last_name' => 'Musovic',
            'email' => 'Musovic@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => Hash::make('1234'),
            'role' => RoleType::SUPERADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        // Admin User
        User::create([
            'name' => 'Aleks',
            'first_name' => 'Aless',
            'last_name' => 'Schneider',
            'email' => 'Aless@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => Hash::make('123456'),
            'role' => RoleType::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
