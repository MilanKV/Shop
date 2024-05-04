<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Enums\BrandStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'brand_name' => 'Lenovo',
            'slug' => Str::random(10),
            'brand_image' => 'images/Brand/Lenovo.jpeg',
            'status' => BrandStatus::ACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'Acer',
            'slug' => Str::random(10),
            'brand_image' => 'images/Brand/Acer.png',
            'status' => BrandStatus::INACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'Dell',
            'slug' => Str::random(10),
            'brand_image' => 'images/Brand/Dell.jpeg',
            'status' => BrandStatus::ACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'Asus',
            'slug' => Str::random(10),
            'brand_image' => 'images/Brand/Asus.jpg',
            'status' => BrandStatus::ACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'HP',
            'slug' => Str::random(10),
            'brand_image' => 'images/Brand/HP.png',
            'status' => BrandStatus::INACTIVE,
        ]);
        
        Brand::create([
            'brand_name' => 'CoolerMaster',
            'slug' => Str::random(10),
            'brand_image' => 'images/Brand/CoolerMaster.png',
            'status' => BrandStatus::ACTIVE,
        ]);
    }
}
