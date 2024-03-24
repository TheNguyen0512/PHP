<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class RegisterController extends Controller
{
    protected $checkSentOtp, $checkVerify;
    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function checkRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'This account already exists'], 400);
        } else {
            $checkSentOtp =  $this->otpService->sentOtp($request);
            if ($checkSentOtp) {
                return response()->json(['message' => 'Valid account'], 200);
            } else {
                return response()->json(['message' => 'Recipient email address is required'], 400);
            }
        }
    }

    public function register(Request $request)
    {
        $checkVerify = $this->otpService->verify($request);
        Log::info($checkVerify);
        if ($checkVerify) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->roles()->sync(4);
            DB::commit();
            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } else {
            return response()->json([
                'message' => 'Invalid OTP'
            ], 400);
        }

       
    }
}
