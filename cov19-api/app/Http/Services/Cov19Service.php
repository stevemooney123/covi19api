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
        $stack = array();

        $object1 = new stdClass();
        $object2 = new stdClass();

        $days = $request->get("days");

        $casesLast7Days = from($this->extracted($request))->select(function ($np) {
            return $np['newCases'];
        })->take(7)->sum($request['newCases']);
        $dailyCases = from($this->extracted($request))->select(function ($np) {
            return $np['newCases'];
        })->take(1)->sum($request['newCases']);
        $totalCases = from($this->extracted($request))->select(function ($np) {
            return $np['cumulativeCases'];
        })->take(1)->sum($request['cumulativeCases']);

        $casesLast7DaysName = "Cases last 7 days";
        $dailyCasesName = "Daily Cases";
        $totalCasesName = "Total Cases";

        $object1->$dailyCasesName = $dailyCases;
        $object1->$casesLast7DaysName = $casesLast7Days;
        $object1->$totalCasesName = $totalCases;


        $deathsLast7Days = from($this->extracted($request))->select(function ($np) {
            return $np['dailyDeaths'];
        })->take(7)->sum($request['dailyDeaths']);
        $deathCases = from($this->extracted($request))->select(function ($np) {
            return $np['dailyDeaths'];
        })->take(1)->sum($request['dailyDeaths']);
        $totalDeaths = from($this->extracted($request))->select(function ($np) {
            return $np['cumulativeDeaths'];
        })->take(1)->sum($request['cumulativeDeaths']);

        $deathsLast7DaysName = "Deaths last 7 days";
        $dailyDeathsName = "Daily Deaths";
        $totalDeathsName = "Total Deaths";

        $object2->$deathsLast7DaysName = $deathsLast7Days;
        $object2->$dailyDeathsName = $deathCases;
        $object2->$totalDeathsName = $totalDeaths;
        $arr = array($object1, $object2);
        return $arr;

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
