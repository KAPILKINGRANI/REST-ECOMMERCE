<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreSellerProductRequest;
use App\Http\Requests\Seller\UpdateSellerProductRequest;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductsController extends ApiController
{
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->showAll($products);
    }

    public function store(StoreSellerProductRequest $request, Seller $seller)
    {
        $data = $request->validated();
        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = '1.jpg';
        $data['seller_id'] = $seller->id;
        $product = Product::create($data);
        return $this->showOne($product, 201);
    }

    public function update(UpdateSellerProductRequest $request, Seller $seller, Product $product)
    {
        /**
         * Points To Remember
         * We Cannot Mark The Product As Available if there is no category associated with it
         */
        $product->fill($request->validated());
        if ($request->status) {
            if ($product->isAvailable() && $product->categories()->count() === 0) {
                throw new HttpException(409, 'A Product Must Be At Least One Category Associated To Mark It is Available');
            }
        }

        if ($product->isClean()) {
            return $this->errorResponse('You Should Update one field at least', 422);
        }

        $product->save();
        return $this->showOne($product);
    }

    public function destroy(Seller $seller, Product $product)
    {
        $this->validateSeller($seller, $product);
        $product->delete();
        return $this->showOne($product, 204);
    }

    private function validateSeller(Seller $seller, Product $product)
    {
        if ($seller->id !== $product->seller_id) {
            throw new HttpException(422, 'You Are Trying To Update Someone Else Product !');
        }
    }
}
