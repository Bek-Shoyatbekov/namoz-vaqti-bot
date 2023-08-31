<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TelegramMicroServiceAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->hasHeader("Secret-key")) 
        {
            abort(401);
        }

        if($request->header("Secret-key") != md5("namozvaqti_bot")) {
            abort(401);
        }
        
        if( !isset($request->user_id) )
        {
            abort(403);
        }

        return $next($request);
    }
}
