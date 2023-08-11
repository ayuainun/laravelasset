<?php

namespace Database\Factories;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'product_transfer' => fake()->randomNumber(6),
            'product_origin' => fake()->randomNumber(6),
            'product_assetID' => fake()->randomNumber(6),
            'product_newassetID' => fake()->randomNumber(6),
            'product_serial' => fake()->randomNumber(6),
            'product_model' => fake()->randomNumber(6),
            'unit_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'size_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'rating_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'brand_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'product_code' => fake()->randomNumber(6),
            'stockin' => fake()->randomNumber(2),
            'stockout' => fake()->randomNumber(2),
            'uom_id' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
