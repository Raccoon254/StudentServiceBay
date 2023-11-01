<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'profile_photo',
        'verification_status',
        'two_factor_code',
        'two_factor_expires_at',
        'two_factor_state',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function generateTwoFactorCode(): ?int
    {
        $this->timestamps = false;
        $this->two_factor_code = $this->generate4DigitsCode();
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
        return $this->two_factor_code;
    }

    public function resetTwoFactorCode(): void
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function setTwoFactorAuthenticated(): void
    {
        $this->timestamps = false;
        $this->two_factor_code = 1; // indicates 2FA authenticated
        $this->two_factor_expires_at = null;
        $this->save();
    }

    private function generate4DigitsCode(): int
    {
        return rand(1000, 9999);
    }

}
