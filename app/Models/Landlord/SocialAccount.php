<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialAccount extends BaseLandlordModel
{
    protected $fillable = [
        'user_id',
        'provider_name',
        'provider_id',
        'access_token',
        'refresh_token',
        'expires_in',
        'token_type',
        'scopes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
