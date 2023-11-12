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

        // Skip 2FA for testing environment
        if (app()->environment('testing')) {
            return $next($request);
        }

        // If two_factor_state is false, we need to require 2FA
        if (!$user->two_factor_state) {
            // Check if the 2FA code is set and not expired
            if (!$user->two_factor_code || $user->isTwoFactorCodeExpired()) {
                // Generate a new 2FA code and send it to the user
                $user->generateTwoFactorCode();
                $this->sendTwoFactorCode($user, $user->two_factor_code);

                // Redirect to the 2FA verification form
                return redirect()->route('two-factor.form');
            }
        }

        // If the user has 2FA enabled and the code is valid, proceed with the request
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
