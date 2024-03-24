<?php

namespace App\Http\Controllers\Customer\Auth;
use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    protected $checkSentOtp, $checkVerify;
    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function index(){
        return view('Customer.Auth.auth');
    }

    public function checkLogin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $checkSentOtp =  $this->otpService->sentOtp($request);
            if($checkSentOtp){
                return response()->json(['message' => 'Account exists'], 200);
            }else{
                return response()->json(['message' => 'Recipient email address is required'], 400);
            }
            
        }
        return response()->json(['message' => 'Invalid email or password'], 400);
        } catch (\Throwable $th) {
            return response()->json(['message' => ' The system is experiencing an error. Please try again later'], 400);
        }     
    }

    public function login(Request $request)
    {
       try {
        $checkVerify = $this->otpService->verify($request);
        if($checkVerify){
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                Auth::login(Auth::user());
                Auth::check();
                $id_get_user = mt_rand(100000, 999999);
                Cache::put('id_get_user' , $id_get_user, now()->addMinutes(60)); 
                Cache::put('user_' .  $id_get_user, $user, now()->addMinutes(60)); 
                return response()->json([
                    'message' => 'succezss'
                ], 200);       
            }
            return response()->json(['message' => 'Invalid email or password'], 400);
        }else{
            return response()->json([
                'message' => 'Invalid OTP'
            ], 400);
        }
       } catch (\Throwable $th) {
            return response()->json([
                'message' => 'The system is experiencing an error. Please try again later'
            ], 400);
       }
    }

    public function logout(){  
        Auth::logout();
        Artisan::call('cache:clear');
        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
}