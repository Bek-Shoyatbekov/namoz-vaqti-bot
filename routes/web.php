<?php

use App\Models\City;
use Illuminate\Support\Facades\Route;
use App\Services\Localization\LocalizationService;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Public\City\CityController;
use App\Http\Controllers\Public\Calendar\CalendarController;
use App\Http\Controllers\Public\Region\RegionController;
use App\Http\Controllers\Admin\TelegramController;
use App\Http\Controllers\Admin\JumaImage\JumaImageController;

Route::group(
    ["middleware" => "check_lang","prefix"=> LocalizationService::locale()], 
    function() {
        Route::get("/", [CityController::class, "index"])->name("index");
        Route::view("/qibla", "qibla")->name("qibla");

        Route::get("/oylik/{month}/{city:slug}", [CalendarController::class, "calendarForMonth"])->name("calendar");
        Route::get("/yillik/{city:slug}", [CalendarController::class, "calendarForYear"])->name("yillik");
        Route::get("/ramazon/{city:slug}", [CalendarController::class, "ramazon"])->name("ramazon");

        Route::group(["prefix" => "viloyat"], function(){
            Route::get("/", [RegionController::class, "index"])->name("viloyat.index"); // list of viloyat
            Route::get("/{region:slug}", [RegionController::class, "show"])->name("viloyat.cities"); // cities of selected viloyat
        });

        Route::group(["prefix" => "shahar"], function(){
            Route::get("/{city:slug}", [CityController::class, "show"])->name("shahar.time");
        });
    }
);

Route::view("login", "login" )->name("login");
Route::post("login", [LoginController::class, "login"]);
Route::get("logout", [LoginController::class, "logout"]);

// Route::get("image", [JumaImageController::class, 'index']);