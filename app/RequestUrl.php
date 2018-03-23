<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestUrl extends Model
{
    public static function GetMethod($reqUrl){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$reqUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }
}
