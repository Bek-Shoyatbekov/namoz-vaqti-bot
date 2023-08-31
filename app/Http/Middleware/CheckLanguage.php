<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CheckLanguage
{

    // private const LANGUAGES = ['en', 'ru', 'oz', 'uz'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        $langPrefix = $request->segment(1);

        if($langPrefix && in_array($langPrefix, config("app.locales"))) {
            App::setLocale($langPrefix);
        } else {
            App::setLocale(config("app.fallback_locale"));
        }

        // dd(App::currentLocale());
        
        return $next($request);

        // $language = $request->lang;

        // if($language == null) $language = $request->session()->get('lang') ?? App::getLocale();

        // if(in_array($language, self::LANGUAGES)) $request->session()->put('lang', $language);
        
        // return $next($request);
    }
}
