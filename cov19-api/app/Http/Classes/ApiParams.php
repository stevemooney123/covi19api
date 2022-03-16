<?php

namespace App\Http\Classes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
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

}
