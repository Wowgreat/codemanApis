<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getLatLon(Request $request){
        $model = new Map();

        $province = $request->input('province');

        $city = $request->input('city');

        $area = $request->input('area');

        $json_obj = $model->getLat_Lon($area,$city);
        return ($json_obj->results);
    }
}
