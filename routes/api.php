<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Admin\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TelegramMicroServiceAuth;



Route::resource("/location", ApiController::class)->only(["index"]);

Route::get("/time/{city}", [ApiController::class, "getTimeForMonth"]);

// Route::get("setwebhook", [TelegramController::class, "setWebhook"]);


Route::middleware(TelegramMicroServiceAuth::class)->prefix("telegram")->group(function() {

	Route::post("start", [TelegramController::class, "start"]);
	
	Route::post("language", [TelegramController::class, "language"]);

	Route::post("regions", [TelegramController::class, "regions"]);

	Route::post("time", [TelegramController::class, "time"]);

	Route::post("unsubscribe", [TelegramController::class, "unsubscribe"]);

	Route::post("setLanguage", [TelegramController::class, "setLanguage"]);

	Route::post("setRegion", [TelegramController::class, "setRegion"]);

	Route::post("setCity", [TelegramController::class, "setCity"]);

	Route::post("stats", [TelegramController::class, "stats"]);

	
});

