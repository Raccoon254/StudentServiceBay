<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScamAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date_reported',
        'location_area',
        'reported_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
