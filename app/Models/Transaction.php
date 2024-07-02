<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected  $fillable = [
        'product_id',
        'buyer_id',
        'quantity'
    ];

    //Transaction belongs to buyer
    public function buyer() : BelongsTo {
        return $this->belongsTo(Buyer::class);
    }

    //Transaction belongs to Product
    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
