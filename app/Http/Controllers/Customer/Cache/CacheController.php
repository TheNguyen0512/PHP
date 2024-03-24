<?php

namespace App\Http\Controllers\Cache;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\isEmpty;

class CacheController extends Controller
{
    public function __construct()
    {

    }

    public function getCache(Request $request)
    {
        $user = Cache::get('user_' . $request->id_get_user);
        if(isEmpty($user)){
            return response()->json(['message' => 'No users'], 400);
        }else{
            return response()->json([
                'user' => $user
            ], 200);;
        }
    }
}
