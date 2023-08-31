<?php

namespace App\Http\Controllers\Public\Sitemap;

use App\Models\City;
use App\Models\Region;
use App\Http\Controllers\Controller;
use App\Models\Ramazon;

class SitemapController extends Controller
{
    public function index(){
        $v = Region::latest()->first();
        $s = City::latest()->first();
        $rs = Ramazon::first()->is_published;
        return response()->view("sitemap.index", ["viloyat" => $v, "shahar" => $s, "rs" =>$rs])
            ->header('Content-Type', 'text/xml');
    }

    public function main(){
        $viloyats = Region::latest()->get();
        return response()->view("sitemap.main")
            ->header('Content-Type', 'text/xml');
    }

    public function viloyats(){
        $viloyats = Region::latest()->get();
        return response()->view("sitemap.viloyats", ["viloyats" => $viloyats])
            ->header('Content-Type', 'text/xml');
    }

    public function shahars(){
        $shahars = City::latest()->get();
        return response()->view("sitemap.shaharlar", ["shahars" => $shahars])
            ->header('Content-Type', 'text/xml');
    }

    public function oylik(){
        $shahars = City::get();
        return response()->view("sitemap.calendar", ["shahars" => $shahars])
            ->header('Content-Type', 'text/xml');
    }

    public function yillik(){
        $shahars = City::get();
        return response()->view("sitemap.yillik", ["shahars" => $shahars])
            ->header('Content-Type', 'text/xml');
    }

    public function ramazon(){
        $rs = Ramazon::first()->state;
        $shahars = City::get();
        return response()->view("sitemap.ramazon", ["shahars" => $shahars, "rs" => $rs])
            ->header('Content-Type', 'text/xml');
    }
}
