<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AuthPageAccess
{
    public function handle(Request $request, Closure $next)
    {
        if(Cache::has('id_get_user')){
            return abort(404, "Can't find this page");   
        }else{
            return $next($request);
        };
    }

}
