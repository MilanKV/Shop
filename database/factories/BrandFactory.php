<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\BrandStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_name' => $this->faker->name,
            'slug' => $this->faker->unique()->slug,
            'brand_image' => $this->faker->imageUrl('100', '100'),
            'status' => $this->faker->randomElement([
                BrandStatus::ACTIVE,
                BrandStatus::INACTIVE
            ])->value,
        ];
    }
}
