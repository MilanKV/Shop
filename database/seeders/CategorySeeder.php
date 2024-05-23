<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Categories
        $categories = [
            [
                'category_name' => 'Computers',
                'slug' => Str::slug('Computers'),
                'short_description' => 'All kinds of computers.',
                'category_image' => 'https://cloudfront-us-east-1.images.arcpublishing.com/gray/QGBEHL7IWZHLTCJ5MFQU53TM6U.jpg',
                'is_parent' => true,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Accessories',
                'slug' => Str::slug('Accessories'),
                'short_description' => 'Computer accessories and peripherals.',
                'category_image' => 'https://www.shutterstock.com/image-photo/computer-peripherals-laptop-accessories-composition-600nw-538320733.jpg',
                'is_parent' => true,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);

        // Insert subcategories
        $subCategories = [
            [
                'category_name' => 'Laptops',
                'slug' => Str::slug('Laptops'),
                'short_description' => 'Wide range of laptops.',
                'category_image' => 'https://johnlewis.scene7.com/is/image/JohnLewis/Laptops-940x700-130423',
                'is_parent' => false,
                'parent_id' => DB::table('categories')->where('category_name', 'Computers')->value('id'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Desktops',
                'slug' => Str::slug('Desktops'),
                'short_description' => 'High-performance desktops.',
                'category_image' => 'https://global.machenike.com/cdn/shop/products/20201109_13968-_1_1_533x.png?v=1680169362',
                'is_parent' => false,
                'parent_id' => DB::table('categories')->where('category_name', 'Computers')->value('id'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Monitors',
                'slug' => Str::slug('Monitors'),
                'short_description' => 'Various sizes and resolutions.',
                'category_image' => 'https://image.benq.com/is/image/benqco/home-herobanner-m-1?$ResponsivePreset$',
                'is_parent' => false,
                'parent_id' => DB::table('categories')->where('category_name', 'Accessories')->value('id'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Keyboards & Mice',
                'slug' => Str::slug('Keyboards & Mice'),
                'short_description' => 'Keyboards and mice for all needs.',
                'category_image' => 'https://m.media-amazon.com/images/I/718xqJg8i8L.jpg',
                'is_parent' => false,
                'parent_id' => DB::table('categories')->where('category_name', 'Accessories')->value('id'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($subCategories);
    }
}
