<?php

namespace App\Http\Controllers;

use App\Http\Classes\ApiParams;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
class Covid19Controller extends Controller
{
    //
    public function cases()
    {
        $apiParams = new ApiParams();

        $apiParams->FiltersType = array(["nation", "Northern Ireland"]);
        $apiParams->StructureType = array(["newCases", "newCasesByPublishDate"]);
        $apiParams->LatestBy = "newCasesByPublishDate";

        $url = $this->BuildUrl($apiParams, 1);

        $response = Http::get($url);

        return  $response->json("data");
    }

    /**
     * @param mixed $baseUrl
     * @param ApiParams $apiParams
     * @return string
     */
    public function BuildUrl(apiParams $apiParams, mixed $page): string
    {   $baseUrl = Config::get('app.apiBaseUrl');
        $url = $baseUrl . '?filters=areaType='
            . $apiParams->FiltersType[0][0] . ';'
            . 'areaName='
            . $apiParams->FiltersType[0][1]
            . "&structure="
            . "{\"MyDate\":\"date\",\"newCases\":\"newCasesByPublishDate\"}" .
            "&latestBy=" . $apiParams->LatestBy . "&page=" . $page . "&format=json";
        return $url;
    }
}
