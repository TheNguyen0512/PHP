<?php
namespace App\Services;

use App\Mail\ForgetPasswordNotification;
use App\Mail\OTPNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
class OtpService
{
    public function sentOtp(Request $request)
    { 
        $otp = mt_rand(100000, 999999);
        $email = $request->email;
        if (!empty($email)) {
           
            Cache::put('otp_' . $email, $otp, now()->addMinutes(5));
            $content = [
                'subject' => 'OTP ITP BLUE',
                'email' => $email,
                'otp' => $otp
            ];
            
            Mail::to($email)->send(new OTPNotification($content));
            return true;
        } else {
            return false;
        }
       
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);
        $otp = Cache::get('otp_' . $request->email);
        if ($otp && $otp == $request->otp) {
            Cache::forget('otp_' . $request->email);
            return true;
        }
        return false;
    }

    public function sentForgetPassword($email, $token)
    { 
        if (!empty($email)) {
            $content = [
                'subject' => 'ITP BLUE Forgot Password',
                'email' => $email,
                'token' => $token,
            ];
            
            Mail::to($email)->send(new ForgetPasswordNotification($content));
            return true;
        } else {
            return false;
        }
       
    }
}