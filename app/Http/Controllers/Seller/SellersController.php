<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellersController extends Controller
{

    //create update and delete operations will
    //not be done for the seller everything else will be done on user
    //User if lists the product  becomes a seller

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = Seller::all();
        return response()->json(['data' => $sellers], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller)
    {
        return response()->json(['data' => $seller]);
    }
}
