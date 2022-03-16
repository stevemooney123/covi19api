<?php

namespace App\Http\Classes;

use Illuminate\Support\Facades\Config;

class HttpClient
{
   public function get(mixed $params){
       $baseUrl = Config::get('app.apiBaseUrl');
   }
}
