<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ProductStatus;
use App\Models\Brand;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brand = Brand::factory()->create();
        $categoryParent = Category::factory()->create(['is_parent' => true]);
        $categorySubcategory = Category::factory()->create(['is_parent' => false]);

        return [
            'product_name' => $this->faker->name,
            'slug' => $this->faker->unique()->slug,
            'product_SKU' => $this->faker->unique()->randomNumber(6),
            'short_description' => $this->faker->sentence,
            'long_descriptions' => $this->faker->paragraph,
            'purchase_price' => $this->faker->randomFloat(10, 2),
            'discount_price' => $this->faker->randomFloat(10, 2),
            'product_color' => $this->faker->colorName,
            'product_size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl('100', '100'),
            'weight' => $this->faker->randomFloat(2, 0.1, 10),
            'status' => $this->faker->randomElement([
                ProductStatus::OUTOFSTOCK,
                ProductStatus::INSTOCK
            ])->value,
            'brand_id' => $brand->id,
            'category_id' => $categoryParent->id,
            'subcategory_id' => $categorySubcategory->id,
        ];
    }
}
