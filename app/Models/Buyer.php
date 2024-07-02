<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//NOTE HERE we don't consider buyer as separate model which extends model
//  therefore we extend user class for buyer
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
    public function transactions() : HasMany {
        return $this->hasMany(Transaction::class);
    }
}
