<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    //in json we dont want to show pivot fields
    protected $hidden =  [
        'pivot'
    ];
    protected $fillable  = [
        'name',
        'description'
    ];

    //Category Belongs To Many Products
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
