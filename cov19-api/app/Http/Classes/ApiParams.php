<?php

namespace App\Http\Classes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Laravel\Sanctum\HasApiTokens;

class ApiParams
{
    public $FiltersType = [
        "key1" => "value1"
    ];

    public $StructureType = [
        "key1" => "value1"
    ];

    public $LatestBy;


    public function BuildArguments($areaType, $areaName, $metric, $metricName)
    {
        $apiParams = new ApiParams();

        $apiParams->FiltersType = array([$areaType, $areaName]);
        $apiParams->StructureType = array([$metric, $metricName]);
        $apiParams->LatestBy = $metricName;

        return $apiParams;
    }

    public function BuildUrl(apiParams $apiParams, mixed $page): string
    {
        $baseUrl = Config::get('app.apiBaseUrl');
        return $baseUrl . '?filters=areaType='
            . $apiParams->FiltersType[0][0] . ';'
            . 'areaName='
            . $apiParams->FiltersType[0][1]
            . "&structure="
            . "{\"date\":\"date\",\"newCases\":\"newCasesByPublishDate\",\"cumulativeCases\":\"cumCasesByPublishDate\",\"dailyDeaths\":\"newDeaths28DaysByPublishDate\",\"cumulativeDeaths\":\"cumDeaths28DaysByPublishDate\"}" .
            "&latestBy=" . $apiParams->LatestBy . "&page=" . $page . "&format=json";
    }
}
