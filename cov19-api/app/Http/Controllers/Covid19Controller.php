<?php

namespace App\Http\Controllers;

use App\Http\Classes\ApiParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Covid19Controller extends Controller
{
    //
    public function NewCases(Request $request)
    {
        $areaType = $request->get("areaType");
        $areaName = $request->get("areaName");
        $metric = $request->get("metric");
        $metricName = $request->get("metricName");

        $apiParams = $this->BuildArguments($areaType, $areaName, $metric, $metricName);

        $url = $this->BuildUrl($apiParams, 1);

        $response = Http::get($url);

        return $response->json("data");
    }

    /**
     * @param mixed $baseUrl
     * @param ApiParams $apiParams
     * @return string
     */
    public function BuildUrl(apiParams $apiParams, mixed $page): string
    {
        $baseUrl = Config::get('app.apiBaseUrl');
        return $baseUrl . '?filters=areaType='
            . $apiParams->FiltersType[0][0] . ';'
            . 'areaName='
            . $apiParams->FiltersType[0][1]
            . "&structure="
            . "{\"MyDate\":\"date\",\"newCases\":\"newCasesByPublishDate\"}" .
            "&latestBy=" . $apiParams->LatestBy . "&page=" . $page . "&format=json";
    }

    /**
     * @return ApiParams
     */
    public function BuildArguments($areaType, $areaName, $metric, $metricName)
    {
        $apiParams = new ApiParams();

        $apiParams->FiltersType = array([$areaType, $areaName]);
        $apiParams->StructureType = array([$metric, $metricName]);
        $apiParams->LatestBy = $metricName;
        return $apiParams;
    }
}
