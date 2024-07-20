<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductBuyerTransactionRequest;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionsController extends ApiController
{
    public function store(StoreProductBuyerTransactionRequest $request, Product $product, Buyer $buyer)
    {
        if ($buyer->id === $product->seller_id) {
            return $this->errorResponse("Woaah We Caught you ! You Are Trying To Increase Your Product Sales", 400);
        }
        if ($request->quantity > $product->quantity) {
            return $this->errorResponse('Request Quantity Too High ! We do not have this much quantity right now!', 400);
        }
        if (!$buyer->isVerified()) {
            return $this->errorResponse('You Should Be Verified To Purchase This Item !', 400);
        }
        if ($product->seller->isVerified()) {
            return $this->errorResponse('Seller of the product is not verfied', 400);
        }

        $transaction = DB::transaction(function () use ($product, $buyer, $request) {
            $product->decrement('quantity', $request->quantity);

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'product_id' => $product->id,
                'buyer_id' => $buyer->id
            ]);
            return $transaction;
        });
        return $this->showOne($transaction);
    }
}
