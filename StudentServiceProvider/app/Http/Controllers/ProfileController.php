<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function dash(Request $request): View
    {
        return view('dashboard', [
            'user' => $request->user(),
        ]);
    }

    public function twoFactorForm(Request $request): View
    {
        return view('auth.two-factor');
    }

    public function twoFactorVerify(Request $request): RedirectResponse
    {
        $request->validate([
            'two_factor_code' => ['required', 'numeric'],
        ]);

        $user = Auth::user();

        if ($user->two_factor_code !== $request->two_factor_code) {
            return redirect()->back()->withErrors(['two_factor' => 'The provided 2FA code is incorrect.']);
        }

        if ($user->two_factor_expires_at <= now()) {
            $user->resetTwoFactorCode();
            return redirect()->route('two-factor.form')->withErrors(['two_factor' => 'The 2FA code has expired. A new one has been sent to your email.']);
        }

        $user->two_factor_state = true;
        $user->resetTwoFactorCode();
        $user->save();

        return Redirect::intended();
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
