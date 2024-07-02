<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//NOTE HERE we don't consider seller as separate model which extends model
//  therefore we extend user class for seller
class Seller extends User
{
    use HasFactory;
    protected $table = 'users';

    //seller has many products
    public function products() :HasMany{
        return $this->hasMany(Product::class);
    }
}
