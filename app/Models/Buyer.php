<?php

namespace App\Models;

use App\Models\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//NOTE HERE we don't consider buyer as separate model which extends model
//  therefore we extend user class for buyer
//scoped by explanation is written at the end of file
#[ScopedBy([BuyerScope::class])]
class
Buyer extends User
{
    use HasFactory;
    /*
    By default, Eloquent (the ORM used by Laravel) assumes that the table name for a model
    is the plural form of the model name (e.g., the Buyer model would correspond to a table named buyers).
    However, in this case, you are explicitly telling Eloquent to use the users table for the Buyer model.
    */
    protected $table = 'users';

    //Buyer has many transactions
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}

/**
 * Global scopes allow you to add constraints to all queries for a given model.
 * jaise buyers bhi users hi hai theek h and a buyer can have many transactions that means a buyer may have transactions or may not
 *scope se humne constraint laga di ki has('transactions') that means wahi buyers aae (wahi users aaye) jinke pass transactions ho
 * ye scope ka concept laravel 11 se aaya hai model ke upar
 * special annotaion #Scope[()] # ke baad space mat dena
 */
