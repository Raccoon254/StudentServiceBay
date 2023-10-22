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

        // If user hasn't provided 2FA code, send one and show the form
        if (!$request->has('two_factor_code')) {
            // If a code isn't generated, generate one, save it and send to email
            if (!$user->two_factor_code) {
                $user->generateTwoFactorCode();  // you'll implement this
                $this->sendTwoFactorCode($user); // you'll implement this
            }

            return redirect()->route('two-factor.form'); // show a form where user can input the code from email
        }

        // If provided code is invalid, redirect back with an error
        if ($request->input('two_factor_code') !== $user->two_factor_code ||
            now()->gt($user->two_factor_expires_at)) {

            // Reset the 2FA code
            $user->resetTwoFactorCode();

            return redirect()->back()->withErrors(['two_factor' => 'The provided 2FA code is invalid or has expired.']);
        }

        // Reset the 2FA code once used
        $user->resetTwoFactorCode();

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
