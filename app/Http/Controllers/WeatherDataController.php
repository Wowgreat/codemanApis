<?php

namespace App\Http\Controllers;



use App\Map;
use App\RequestUrl;

class WeatherDataController extends Controller
{
    protected $API_KEY = '8d3913ac5329dcbf7fccae71004e8b95';
    protected $BASE_URL = 'http://api.openweathermap.org/data/2.5/';
    protected $IMG_URL = 'https://openweathermap.org/img/w/';

    public function getData($type,$city,$area){
        $mapModel = new Map();

        if ($city&&$area){
            $areaObj = $mapModel->getLat_Lon($area,$city);
        }else{
            return ['cod'=>1,'msg'=>'Please check the parameters are complete'];
        }
        //if there is not the location you searched.
        try{
            $location = $areaObj->results[0]->location;
        }catch (\Exception $errorException){
            return ['cod'=>2,'msg'=>'There is no such place you searched'];
        }

        $reqUrl = $this->BASE_URL.$type.'?type=accurate&units=metric&APPID='.$this->API_KEY.'&lat='.$location->lat.'&lon='.$location->lng;

        $json_obj = RequestUrl::GetMethod($reqUrl);

        if ('forecast'==$type){
            $list = $json_obj->list;
            foreach ($list as $item){
                $item->dt_txt = date('Y-m-d H:i:s',$item->dt);
                $item->weather[0]->icon = $this->IMG_URL.$item->weather[0]->icon.'.png';
            }
            return json_encode($json_obj);
        }else{
            $json_obj->weather[0]->icon = $this->IMG_URL.$json_obj->weather[0]->icon.'.png';
            return json_encode($json_obj);
        }

    }
}