<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;

class APIConttoller extends Controller
{
    use ApiResponser;

    public function __construct()
    {
//        $this->middleware('auth:api');
    }
}
