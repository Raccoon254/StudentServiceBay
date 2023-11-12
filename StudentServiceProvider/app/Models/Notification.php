<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'users',
        'alert_id',
        'content',
    ];

    protected $casts = [
        'users' => 'array',
    ];

    public function alert(): BelongsTo
    {
        return $this->belongsTo(ScamAlert::class);
    }

}
