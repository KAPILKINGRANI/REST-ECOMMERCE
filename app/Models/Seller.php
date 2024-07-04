<?php

namespace App\Models;

use App\Models\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//NOTE HERE we don't consider seller as separate model which extends model
//  therefore we extend user class for seller
#[ScopedBy(([SellerScope::class]))]
class Seller extends User
{
    use HasFactory;
    protected $table = 'users';

    //seller has many products
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
/**
 * Global scopes allow you to add constraints to all queries for a given model.
 * jaise sellers bhi users hi hai theek h and a seller can have many products that means a buyer may have products or may not
 *scope se humne constraint laga di ki has('products') that means wahi Sellers aae (wahi users aaye) jinke pass Products ho
 * ye scope ka concept laravel 11 se aaya hai model ke upar
 * special annotaion #Scope[()] # ke baad space mat dena
 */
