<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->belongsTo(User::class);
    }
}
