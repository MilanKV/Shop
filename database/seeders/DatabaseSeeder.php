<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;


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

        Brand::factory(3)->create();
        Category::factory(5)->create();
        Product::factory(20)->create();
    }
}
