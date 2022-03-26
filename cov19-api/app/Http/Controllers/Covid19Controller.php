<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Cov19Service;

class Covid19Controller extends Controller
{
    //
    public function GetAllMetrics(Request $request)
    {
        $Covid19Service = new Cov19Service();
        return $Covid19Service->GetMetrics($request);

    }

    public function GetLast7Days(Request $request)
    {
        $Covid19Service = new Cov19Service();
        return $Covid19Service->GetLast7Days($request);

    }
}
