<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
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
            'name' => fake()->unique()->word(),
            'description' => fake()->paragraph(1),
            'quantity' => fake()->numberBetween(1,100),
            //status should be from our defined constants only
            //that s why we have used this kind of syntax
            'status' => fake()->randomElement([Product::AVAILABLE_PRODUCT,Product::UNAVAILABLE_PRODUCT]),
            'image' => fake()->randomElement(['1.jpg','2.jpg','3.jpg']),
            //user mai se koi bhi random id leke aa
            'seller_id' => User::all()->random()->id
        ];
    }
}
