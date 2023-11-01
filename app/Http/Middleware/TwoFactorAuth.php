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

        if (!$user->two_factor_state) {
            // if two_factor_state is false, we need to require 2FA
            if (!$user->two_factor_code || !$user->two_factor_expires_at) {
                $user->generateTwoFactorCode();
                $this->sendTwoFactorCode($user, $user->two_factor_code);
                return redirect()->route('two-factor.form');
            }
        } else {
            return $next($request);
        }
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
