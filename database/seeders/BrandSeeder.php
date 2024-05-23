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
            'brand_image' => 'https://static.vecteezy.com/system/resources/previews/020/927/085/original/lenovo-logo-brand-phone-symbol-red-design-china-mobile-illustration-free-vector.jpg',
            'status' => BrandStatus::ACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'Acer',
            'slug' => Str::random(10),
            'brand_image' => 'https://static.vecteezy.com/system/resources/previews/019/136/299/non_2x/acer-logo-acer-icon-free-free-vector.jpg',
            'status' => BrandStatus::INACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'Dell',
            'slug' => Str::random(10),
            'brand_image' => 'https://media.designrush.com/inspirations/287192/conversions/dell-logo-design-1-preview.jpg',
            'status' => BrandStatus::ACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'Asus',
            'slug' => Str::random(10),
            'brand_image' => 'https://logowik.com/content/uploads/images/424_asus.jpg',
            'status' => BrandStatus::ACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'HP',
            'slug' => Str::random(10),
            'brand_image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqf4mJJFie-ocl1j3Lt9z7-Y7MV-Ii5koYPfnPkby5FQ&s',
            'status' => BrandStatus::INACTIVE,
        ]);

        Brand::create([
            'brand_name' => 'CoolerMaster',
            'slug' => Str::random(10),
            'brand_image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuU5xczfVONMzwznLW_Ci7iSIb0BgrVWYkIAEmKpHisQ&s',
            'status' => BrandStatus::ACTIVE,
        ]);
    }
}
