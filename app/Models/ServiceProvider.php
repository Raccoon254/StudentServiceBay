<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'description',
        'email',
        'contact_number',
        'address',
        'service_type',
        'verification_status',
        'profile_image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //is_verified
    public function getIsVerifiedAttribute(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function serviceReviewRatings(): HasMany
    {
        return $this->hasMany(ServiceReviewRating::class, 'service_provider_id');
    }
}
