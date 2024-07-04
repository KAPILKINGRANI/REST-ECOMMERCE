<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyersController extends Controller
{
    //create update and delete operations will
    //not be done for the buyer everything will be done on user
    //User if purchases becomes a buyer
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::all();
        return response()->json(['data' => $buyers], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buyer $buyer)
    {
        return response()->json(['data' => $buyer], 200);
    }
}
