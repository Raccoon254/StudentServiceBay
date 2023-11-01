<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TwoFactorAuth
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();


        //if two_factor_expires_at is later than now and two_factor_code is not 1
        if ($user->two_factor_code == 1) {
            return $next($request);
        }

        // Check if the user 2FA is code
        if (!$user->two_factor_code || !$user->two_factor_expires_at) {
           //generate a new code
            $user->generateTwoFactorCode();
            //send the code
            $this->sendTwoFactorCode($user, $user->two_factor_code);
            //redirect to the 2FA form
            return redirect()->route('two-factor.form');
        }

        return $next($request);
    }

    protected function sendTwoFactorCode($user, $code): void
    {
        Mail::raw(
            "Your two-factor code is {$code}",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Two Factor Code');
            }
        );
    }
}
