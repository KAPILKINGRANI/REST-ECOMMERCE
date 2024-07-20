<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function updated(Product $product): void
    {
        if ($product->quantity === 0 && $product->isAvailable()) {
            $product->status = Product::UNAVAILABLE_PRODUCT;
            $product->save();
        }
    }
}
