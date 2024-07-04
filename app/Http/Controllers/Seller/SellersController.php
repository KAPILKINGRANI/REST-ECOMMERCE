<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

//note SellersController is extending ApiController
//ApiController extends the controller
//need of apiController because of standardization
//all the methods such as show all ,show one ,error message is written inside api controller and we make use of those methods here
class SellersController extends ApiController
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
        // return response()->json(['data' => $sellers], 200);

        return $this->showAll($sellers);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller)
    {
        // return response()->json(['data' => $seller]);
        return $this->showOne($seller);
    }
}
