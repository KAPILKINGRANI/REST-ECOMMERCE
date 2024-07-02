<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        Category::all(): Fetches all categories from the database.
        ->random(random_int(1,5)): Randomly selects between 1 and 5 categories from the collection retrieved by Category::all().
        ->pluck('id'): Retrieves only the id attribute of the randomly selected categories.

        $product->categories()->attach($categories):
        This line attaches the randomly selected categories to the current $product.
         It uses the attach method, which is used in many-to-many relationships in Laravel's Eloquent ORM to attach related models to each other through an intermediate table.
         */
        Product::factory(100)
            ->create()
            ->each(function($product) {
               $categories = Category::all()->random(random_int(1,5))->pluck('id');
               $product->categories()->attach($categories);
            }) ;
    }
}
