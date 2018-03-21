<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherDataController extends Controller
{
    protected $Api_key = '8d3913ac5329dcbf7fccae71004e8b95';
    protected $BASE_URL = 'http://api.openweathermap.org/data/2.5/';
    protected $IMG_URL = 'https://openweathermap.org/img/w/01n.png';

    public function getData($type){
        $lat='31.247291';
        $lon='121.444966';
        $reqUrl = $this->BASE_URL.$type.'?units=metric&APPID='.$this->Api_key.'&lat='.$lat.'&lon='.$lon;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$reqUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}