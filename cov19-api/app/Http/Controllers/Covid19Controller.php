<?php

namespace App\Http\Controllers;

use App\Http\Classes\ApiParams;
use Illuminate\Support\Facades\Config;

class Covid19Controller extends Controller
{
    //
    public function cases()
    {

        $apiParams = new ApiParams();

        $apiParams->FiltersType = array(["nation", "Northern Ireland"]);
        $apiParams->StructureType = array(["newCases", "newCasesByPublishDate"]);
        $apiParams->LatestBy = "newCasesByPublishDate";



        $url = $this->BuildUrl($apiParams);


        return $url;
    }

    /**
     * @param mixed $baseUrl
     * @param ApiParams $apiParams
     * @return string
     */
    public function BuildUrl(apiParams $apiParams): string
    {   $baseUrl = Config::get('app.apiBaseUrl');
        $url = $baseUrl . '?filters=areaType='
            . $apiParams->FiltersType[0][0] . ';'
            . 'areaName='
            . $apiParams->FiltersType[0][1]
            . "&structure="
            . json_encode((object)$apiParams->StructureType[0], JSON_PRETTY_PRINT) .
            "&latestBy=" . $apiParams->LatestBy . "&page=1" . "&format=json";
        return $url;
    }
}
