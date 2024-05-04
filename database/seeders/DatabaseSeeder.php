<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CreateUserSeeder::class,
            BrandSeeder::class,
        ]);

        // Category::factory(6)->create();
    }
}
