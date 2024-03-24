<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class UserPageAccess
{
    public function handle($request, Closure $next)
    {
        if(Cache::has('id_get_user')){
            $id_get_user = Cache::get('id_get_user');
            $userID = Cache::get('user_' . $id_get_user);
            $user = User::find($userID['id']);  
            Auth::login($user);
            if (Auth::check()) {
                $customer = false;
                foreach (Auth::user()->roles as $item) {
                    if($item['name'] === 'Customer'){
                        $customer = true;
                    }
                }
                if ($customer) {
                    return $next($request); 
                }
                return abort(404, "Can't find this page");
            }     
        }else{
            if (Auth::check()) {
                Auth::logout();
            }
            return $next($request);
        }
    }
}
