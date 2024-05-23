<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Enums\ProductStatus;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_name' => 'Laptop X1',
                'slug' => 'laptop-x1',
                'product_SKU' => 1001,
                'short_description' => 'High-performance laptop for professionals.',
                'long_descriptions' => 'The Laptop X1 combines powerful performance with sleek design, making it ideal for business and creative tasks.',
                'purchase_price' => 1200,
                'discount_price' => 1100,
                'product_color' => 'Silver',
                'product_size' => '15.6 inches',
                'quantity' => 50,
                'image' => 'https://cdn.thewirecutter.com/wp-content/media/2023/06/businesslaptops-2048px-0943.jpg',
                'weight' => 1.5,
                'status' => ProductStatus::INSTOCK->value,
                'brand_id' => 1,
                'category_id' => 1,
                'subcategory_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Smartphone Z2',
                'slug' => 'smartphone-z2',
                'product_SKU' => 1002,
                'short_description' => 'Feature-packed smartphone for modern lifestyles.',
                'long_descriptions' => 'The Smartphone Z2 boasts cutting-edge features, including a high-resolution camera, fast processor, and long-lasting battery.',
                'purchase_price' => 800,
                'discount_price' => 750,
                'product_color' => 'Black',
                'product_size' => '6.2 inches',
                'quantity' => 100,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdnGcg9K-371OeW8vOOzYfRu2tsNfJ5ff4f7xS5wzynQ&s',
                'weight' => 0.3,
                'status' => ProductStatus::OUTOFSTOCK->value,
                'brand_id' => 2,
                'category_id' => 2,
                'subcategory_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Smart Watch W1',
                'slug' => 'smart-watch-w1',
                'product_SKU' => 1003,
                'short_description' => 'Stylish smartwatch for fitness enthusiasts.',
                'long_descriptions' => 'The Smart Watch W1 tracks your fitness activities, monitors heart rate, and syncs seamlessly with your smartphone.',
                'purchase_price' => 150,
                'discount_price' => 130,
                'product_color' => 'Rose Gold',
                'product_size' => 'Adjustable',
                'quantity' => 75,
                'image' => 'https://asia-exshopstatic-vivofs.vivo.com/KuCZNhz3cVxH4yrP/bd/1683799852795/f456319d988ef0d23ab536ab05e4ed4a.png_w860-h860.webp',
                'weight' => 0.1,
                'status' => ProductStatus::INSTOCK->value,
                'brand_id' => 3,
                'category_id' => 3,
                'subcategory_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Wireless Headphones H3',
                'slug' => 'wireless-headphones-h3',
                'product_SKU' => 1004,
                'short_description' => 'Premium wireless headphones for immersive audio experiences.',
                'long_descriptions' => 'The Wireless Headphones H3 deliver crystal-clear sound and comfortable wear, perfect for music lovers and gamers.',
                'purchase_price' => 100,
                'discount_price' => 90,
                'product_color' => 'Blue',
                'product_size' => 'Adjustable',
                'quantity' => 120,
                'image' => 'https://www.gamecentar.rs/media/catalog/product/cache/3f726396bb6a19726231308fc4c8c5aa/3/1/31486-thumbnailasus-tuf-gaming-h3-wireless-slusalice-cena-prodaja.jpg',
                'weight' => 0.2,
                'status' => ProductStatus::OUTOFSTOCK->value,
                'brand_id' => 4,
                'category_id' => 4,
                'subcategory_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Gaming Console G4',
                'slug' => 'gaming-console-g4',
                'product_SKU' => 1005,
                'short_description' => 'Next-gen gaming console for thrilling gaming experiences.',
                'long_descriptions' => 'The Gaming Console G4 delivers cutting-edge graphics, immersive gameplay, and a vast library of games for all gaming enthusiasts.',
                'purchase_price' => 400,
                'discount_price' => 380,
                'product_color' => 'Black',
                'product_size' => 'Standard',
                'quantity' => 80,
                'image' => 'https://m.media-amazon.com/images/I/61T2RHj+OHL.jpg',
                'weight' => 2.0,
                'status' => ProductStatus::INSTOCK->value,
                'brand_id' => 5,
                'category_id' => 5,
                'subcategory_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Product::insert($products);
    }
}
