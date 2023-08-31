<?php

namespace App\Http\Controllers\Public\City;

use Mobile_Detect;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ramazon;

class CityController extends Controller
{
    private Mobile_Detect $detect;
    public function __construct(Mobile_Detect $detect)
    {
        $this->detect = $detect;   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ramazon = Ramazon::first();
        return $this->detect->isMobile()
                ? view("mobile", compact('ramazon'))
                : view("index", compact('ramazon'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $ramazon = Ramazon::first();
        session()->put("city", $city);
        return $this->detect->isMobile()
                ? view("mobile", compact('ramazon'))
                : view("index", compact('ramazon'));
    }

}
