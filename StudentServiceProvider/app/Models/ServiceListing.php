<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider_id',
        'service_description',
        'service_price',
    ];

    public function service_provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
