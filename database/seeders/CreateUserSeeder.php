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
            'email' => 'user@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => Hash::make('12345678'),
            'image' => 'https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg',
            'role' => RoleType::USER,
            'status' => UserStatus::ACTIVE,
        ]);

        // Superadmin User
        User::create([
            'name' => 'Stefo',
            'first_name' => 'Stefan',
            'last_name' => 'Musovic',
            'email' => 'sadmin@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => Hash::make('1234'),
            'image' => 'https://images.pexels.com/photos/1310522/pexels-photo-1310522.jpeg?cs=srgb&dl=pexels-george-dolgikh-551816-1310522.jpg&fm=jpg',
            'role' => RoleType::SUPERADMIN,
            'status' => UserStatus::ACTIVE,
        ]);

        // Admin User
        User::create([
            'name' => 'Aleks',
            'first_name' => 'Aless',
            'last_name' => 'Schneider',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => Hash::make('123456'),
            'image' => 'https://img.freepik.com/free-photo/portrait-optimistic-businessman-formalwear_1262-3600.jpg',
            'role' => RoleType::ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
