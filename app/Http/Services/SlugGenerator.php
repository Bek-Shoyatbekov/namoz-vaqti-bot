<?php 


namespace App\Http\Services;

use App\Models\City;
use App\Models\Region;

class SlugGenerator{


    public static function checkRegion(string $slug, bool $isNew = true, Region $region = null) {
        
        return $isNew 
                    ? Region::where('slug', $slug)->count() < 1
                    : Region::where(['slug' => $slug])->whereNotIn('id', [$region->id])->count() < 1;
    }

    public static function checkCity(string $slug, bool $isNew = true, City $city = null) {
        
        return $isNew 
                    ? City::where('slug', $slug)->count() < 1
                    : City::where(['slug' => $slug])->whereNotIn('id', [$city->id])->count() < 1;
    }
}