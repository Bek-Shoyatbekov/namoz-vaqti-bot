<?php
/**
 * Created by PhpStorm.
 * User: Viktor
 * Date: 30.09.2019
 * Time: 23:13
 */
;

namespace App\Services\Localization;

class Localization
{
    public function locale() {

        $locale = request()->segment(1, '');
        
        if($locale && in_array($locale, config("app.locales"))) {
            return $locale;
        } 
        return "";
    }
}