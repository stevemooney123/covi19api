<?php

namespace App\Http\Services;

use App\Http\Classes\ApiParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Cov19Service
{
    public function GetMetrics(Request $request)
    {

        $areaType = $request->get("areaType");
        $areaName = $request->get("areaName");
        $metric = $request->get("metric");
        $metricName = $request->get("metricName");
        $page = $request->get("page");

        $apiParams = new ApiParams();

        $params = $apiParams->BuildArguments($areaType, $areaName, $metric, $metricName);

        $url = $apiParams->BuildUrl($params, $page);

        $response = Http::get($url);

        return $response->json("data")[0];

    }
}
