<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    const UNAVAILABLE_PRODUCT = 'unavailable';
    const AVAILABLE_PRODUCT = "available";

    protected $fillable  = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
   ];
    //Product belongs to many category
    public function categories() : BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    //one product belongs to one seller
    public function seller() : BelongsTo {
        return $this->belongsTo(Seller::class);
    }

    //a product has many transactions
    public function transactions() : HasMany {
        return $this->hasMany(Transaction::class);
    }

    public function isAvailable() : bool {
        return $this->status === self::AVAILABLE_PRODUCT;
    }
}
