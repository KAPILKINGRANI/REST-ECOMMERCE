<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerCategoriesController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()->with('product.categories')->get()->pluck('product.categories')->flatten()->unique()->values();

        return $this->showAll($categories);
    }
}
