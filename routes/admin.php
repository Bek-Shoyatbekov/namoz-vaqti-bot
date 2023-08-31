<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin", "as" => "admin."], function() {
    Route::get("/", [\App\Http\Controllers\Admin\AdminController::class, "index"])->name("index");

    Route::get("/telegramUpdates", [\App\Http\Controllers\Admin\TelegramController::class, "updates"])->name("telegram.updates");

    Route::resource("shahars", \App\Http\Controllers\Admin\City\CityController::class)->parameters([
        "shahars" => "city" 
    ]);
    Route::resource("viloyats", \App\Http\Controllers\Admin\Region\RegionController::class)->parameters([
        "viloyats" => "region"
    ]);

    Route::resource("shahars.time", \App\Http\Controllers\Admin\GeneratedTime\GeneratedTimesController::class)->parameters([
        "shahars" => "city",
        "time" => "generated_time"
    ])->except(["index"]);
    
    Route::post("shahars/{city}/time/generete", 
        [\App\Http\Controllers\Admin\GeneratedTime\GeneratedTimesController::class, "generate"])
        ->name("shahars.time.generate");
    

    Route::get("check-city-slug/{region?}", [\App\Http\Controllers\Admin\City\CityController::class, "checkSlug"])->name("shahars.check-slug");
    Route::get("check-viloyat-slug/{city?}", [\App\Http\Controllers\Admin\Region\RegionController::class, "checkSlug"])->name("viloyats.check-slug");

    Route::resource("maintimes", \App\Http\Controllers\Admin\Maintime\MaintimeController::class)->except(["show"]);
    Route::post("maintimes/generate", [\App\Http\Controllers\Admin\Maintime\MaintimeController::class, "generate"])->name("maintimes.generate");

    Route::get("server", [\App\Http\Controllers\Admin\AdminController::class, "viewForServer"])->name("viewForServer");
    Route::post("server", [\App\Http\Controllers\Admin\AdminController::class, "generatedForServer"])->name("generatedForServer");

    Route::get("ramazon", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "index"])->name("ramazon.index");
    Route::get("ramazon/change", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "changeStatus"])->name("ramazon.change");
    Route::put("ramazon/edit", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "edit"])->name("ramazon.edit");
    Route::post("ramazon/create", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "create"])->name("ramazon.create");
});