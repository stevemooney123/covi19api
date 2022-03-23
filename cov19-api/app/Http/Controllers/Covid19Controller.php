<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Cov19Service;

class Covid19Controller extends Controller
{
    //
    public function Data(Request $request)
    {
        $Covid19Service = new Cov19Service();
        return $Covid19Service->GetMetrics($request);

    }

}
