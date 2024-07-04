<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    protected function showAll(Collection $data, int $code = 200)
    {
        return response()->json(['data' => $data], $code);
    }
    protected function showOne(Model $model, int $code = 200)
    {
        return response()->json(['data' => $model], $code);
    }
    protected function errorResponse($message, $code)
    {
        return response()->json(['data' => $message], $code);
    }
    
}
