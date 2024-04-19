<?php

namespace Database\Factories;

use App\Models\Category;
use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryIds = Category::pluck('id')->toArray();

        return [
            'category_name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'short_description' => $this->faker->sentence(5),
            'category_image' => $this->faker->imageUrl('100', '100'),
            'is_parent' => $this->faker->boolean(70),
            'parent_id' => count($categoryIds) > 0 ? $this->faker->randomElement($categoryIds) : null,
            'status' => $this->faker->randomElement([
                CategoryStatus::ACTIVE,
                CategoryStatus::INACTIVE
            ])->value,
        ];
    }
}
