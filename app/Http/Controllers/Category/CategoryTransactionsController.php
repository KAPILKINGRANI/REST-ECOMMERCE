<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryTransactionsController extends ApiController
{
    public function index(Category $category)
    {
        $categories = $category->products()->has('transactions')->with('transactions')->get()->pluck('transactions')->flatten();

        return $this->showAll($categories);
    }
}
