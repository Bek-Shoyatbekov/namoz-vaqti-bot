<?php
namespace App\Http\Services;

class TimeDifferenceCalculator{
    
    static function calculate($main, $diff){
        $time = explode(":", $main);
        $hours = intval($time[0]);
        $minutes = intval($time[1]);
        $diff = intval($diff);
        $minutes = $minutes + $diff;
        if($minutes > 59){
            $minutes = $minutes - 60;
            $hours++;
        }
        else if($minutes < 0){
            $minutes = 60 + $minutes;
            $hours--;
        }
        if($hours < 10 & $hours >= 0) $hours = "0".$hours;
        if($minutes < 10 && $minutes >= 0) $minutes = "0".$minutes;
        return $hours.":".$minutes;
    }

}
