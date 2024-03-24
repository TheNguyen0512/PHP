<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\isEmpty;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $id_get_user = Cache::get('id_get_user');
        if(!isEmpty($id_get_user)){
            $user = Cache::get('user_' . $id_get_user);
            $user = User::find($user['id']);
            Auth::login($user);     
            if (Auth::check() ) {
                foreach (Auth::user()->roles as $item) {
                    if($item['name'] === $role){
                        return $next($request);
                    }
                }
               
            }
        }
       
        return abort(404, "Can't find this page");
    }
}
