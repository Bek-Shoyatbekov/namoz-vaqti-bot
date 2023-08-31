<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\Sitemap\SitemapController;


Route::group(["prefix" => "sitemap.xml"], function(){
    Route::get('/', [SitemapController::class, "index"])->name("sitemap.index");
    Route::get('/main', [SitemapController::class, "main"])->name("sitemap.main");
    Route::get('/viloyat', [SitemapController::class, "viloyats"])->name("sitemap.viloyats");
    Route::get('/shahar', [SitemapController::class, "shahars"])->name("sitemap.shahar");
    Route::get('/oylik', [SitemapController::class, "oylik"])->name("sitemap.oylik");
    Route::get('/yillik', [SitemapController::class, "yillik"])->name("sitemap.yillik");
    Route::get('/ramazon', [SitemapController::class, "ramazon"])->name("sitemap.ramazon");
});