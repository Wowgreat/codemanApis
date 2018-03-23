<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    private $AK = 'vP9BjbfqzlAYkc4ZUNNgpFok1r5hyGdK';
    public function getLat_Lon($area,$city){

        $reqUrl="http://api.map.baidu.com/place/v2/search?query=".$area."&region=".$city."&city_limit=true&output=json&ak=".$this->AK;
        try{
            return RequestUrl::GetMethod($reqUrl);
        }catch (\NotFoundHttpException $e){
            throwException($e);
        }
    }
}
