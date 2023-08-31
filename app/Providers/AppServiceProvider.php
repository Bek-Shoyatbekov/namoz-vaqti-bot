<?php

namespace App\Providers;

use App\Models\City;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Admin\Cities\CityTable;
use App\View\Components\Admin\Regions\RegionTable;
use App\View\Components\MiddleNavigation;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        View::share("shahars", City::orderBy("order")->get());

        
        Blade::component('admin-city-table', CityTable::class);
        Blade::component('admin-regions-table', RegionTable::class);
        Blade::component("middle-navigation", MiddleNavigation::class);
        if(env("APP_ENV") !== "local"){
            URL::forceScheme("https");
        }

        
        if(session()->get("city") == null){
            session()->put("city", City::orderBy("id")->first());
        }


    }
}
