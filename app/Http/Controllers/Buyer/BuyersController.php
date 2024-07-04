<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

//note BuyersController is extending ApiController
//ApiController extends the controller
//need of apiController because of standardization
//all the methods such as show all ,show one ,error message is written inside api controller and we make use of those methods here

class BuyersController extends ApiController
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
        //1st method
        // return response()->json(['data' => $buyers], 200);

        //2nd method (using apicontroller and trait)
        return $this->showAll($buyers);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buyer $buyer)
    {
        //return response()->json(['data' => $buyer], 200);

        return $this->showOne($buyer);
    }
}
