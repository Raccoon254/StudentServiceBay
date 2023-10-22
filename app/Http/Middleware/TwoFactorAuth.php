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

        // If user's 2FA code is set to 1, they're already authenticated, so continue
        if ($user->two_factor_code === 1) {
            return $next($request);
        }

        // If user hasn't provided 2FA code, send one and show the form
        if (!$request->has('two_factor_code')) {
            // If a code isn't generated or is 1, generate one, save it and send to email
            if (!$user->two_factor_code) {
                $user->generateTwoFactorCode();
                $this->sendTwoFactorCode($user);
            }

            return redirect()->route('two-factor.form');
        }

        // If provided code is invalid or expired
        if ($request->input('two_factor_code') !== $user->two_factor_code ||
            now()->gt($user->two_factor_expires_at)) {

            // Reset the 2FA code
            $user->resetTwoFactorCode();

            return redirect()->back()->withErrors(['two_factor' => 'The provided 2FA code is invalid or has expired.']);
        }

        // Set the 2FA code to 1 to indicate the user is 2FA authenticated
        $user->setTwoFactorAuthenticated();

        return $next($request);
    }


    protected function sendTwoFactorCode($user): void
    {
        Mail::raw(
            "Your two-factor code is {$user->two_factor_code}",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Two Factor Code');
            }
        );
    }
}
