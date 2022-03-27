<?php

namespace App\Http\Services;

use App\Http\Classes\ApiParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use stdClass;
use \YaLinqo\Enumerable;
class Cov19Service
{
    public function GetMetrics(Request $request)
    {

        return $this->extracted($request);

    }

    public function GetLast7Days(Request $request)
    {
        $object = new stdClass();

        $days = $request->get("days");

        $casesLast7Days = from($this->extracted($request))->select(function($np){ return $np['newCases']; })->take($days)->sum($request['newCases']);
        $dailyCases = from($this->extracted($request))->select(function($np){ return $np['dailyDeaths']; })->take(1)->sum($request['dailyDeaths']);
        $totalCases = from($this->extracted($request))->select(function($np){ return $np['cumulativeCases']; })->take(1)->sum($request['cumulativeCases']);

        $casesLast7DaysName = "Cases last 7 days";
        $dailyCasesName = "Daily Cases";
        $totalCasesName = "Total Cases";
        $object->$casesLast7DaysName =$casesLast7Days;
        $object->$dailyCasesName =$dailyCases;
        $object->$totalCasesName =$totalCases;


        return $object;

    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function extracted(Request $request): mixed
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

        return $response->json("data");
    }
}
