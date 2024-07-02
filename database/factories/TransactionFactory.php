<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends
 * \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //we want only those seller who has products
        //that s why we are using an eloquent relationship method has
        //Model::has()
        //and to avoid n+1 query we are using with
        $seller = Seller::has('products')->with('products')->get()->random();

        //a seller can't buy its own products that's why except is used
        $buyer = User::all()->except($seller->id)->random();
        $product = $seller->products->random();
        return [
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity' => fake()->numberBetween(1,$product->quantity)
        ];
    }
}
