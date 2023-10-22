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

        $user = $request->user();

        if ($request->input('two_factor_code') !== $user->two_factor_code ||
            now()->gt($user->two_factor_expires_at)) {

            // Reset the 2FA code
            $user->resetTwoFactorCode();

            return Redirect::back()->withErrors(['two_factor' => 'The provided code is invalid.']);
        }

        // Set the user as 2FA authenticated
        $user->setTwoFactorAuthenticated();

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
