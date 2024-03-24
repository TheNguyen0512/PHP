<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class ForgetPasswordController extends Controller
{
    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function index()
    {
        return view('Customer.Auth.forgetPassword');
    }

    public function showResetPasswordForm($token,$email)
    {
        return view('Customer.Auth.resetPassword', ['token' => $token, 'email' => $email]);
    }

    public function submitForgetPasswordForm(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            $token = Str::random(64);
            $user = User::where('email', $request->email)->first();
            if (isEmpty($user)) {
                $checkSentOtp =  $this->otpService->sentForgetPassword($user->email, $token);
                $user->remember_token = $token; // Change 'name' to the field you want to update
                $user->save();
                if ($checkSentOtp) {
                    return response()->json(['message' => 'We have e-mailed your password reset link!'], 200);
                } else {
                    return response()->json(['message' => 'Recipient email address is required'], 400);
                }
            }
            return response()->json(['message' => 'Recipient email address is required'], 400);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['message' => ' The system is experiencing an error. Please try again later'], 400);
        }
    }

    public function submitResetPasswordForm(Request $request)
    {
        try {
            Log::info("user ");
            $user = User::where([
                'email' => $request->email,
                'remember_token' => $request->token,
            ])->first();
            Log::info("user ".$user);
            if (!isEmpty($user)) {
                return response()->json(['message' => 'Invalid token!'], 400);
            }
            $user->password = Hash::make($request->password);
            $user->remember_token = null;
            $user->save();
            return response()->json(['message' => 'Your password has been changed!'], 200);
        } catch (\Throwable $th) {
            Log::info("user ".$th);
            return response()->json(['message' => ' The system is experiencing an error. Please try again later'], 400);
        }
    }
}
