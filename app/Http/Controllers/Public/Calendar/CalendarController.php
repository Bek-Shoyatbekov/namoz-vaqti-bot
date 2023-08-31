<?php

namespace App\Http\Controllers\Public\Calendar;

use App\Models\City;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    
    public function calendarForMonth(int $month, City $city) : View
    {
        session()->put("city", $city);
        $times = $city->month($month)->get();
        $weekdays = __("public.weekdays");
        return view("calendar", compact(["month", "city", "times", "weekdays"]));
    }

    public function calendarForYear(City $city) : View
    {    
        session()->put("city", $city);
        return view("yillik", compact("city"));
    }

    public function ramazon(City $city)
    {
        session()->put("city", $city);
        return view("ramazon");
    }
}
