<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Api\TimeResource;
use App\Http\Resources\Api\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiController extends Controller
{
    public function index()
    {
    	$cities = City::with("region")->orderBy("order")->get();
    	return $cities;
    }

    public function show(Region $region): JsonResource
    {
        return LocationResource::collection($region->cities);
    }

    public function getTimeForWeek(Request $request, City $city): JsonResource
    {
        $dates = $city->week;
        
        return TimeResource::collection($dates);
    }

    public function getTimeForMonth(Request $request, City $city): JsonResource
    {
        $dates = $city->generated_times()->where("gregorian_date", ">=", date("Y-m-d"))->paginate(31);

        return TimeResource::collection($dates);
    }

}

