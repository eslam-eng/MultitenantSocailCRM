<?php

namespace App\Models\Landlord;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\SupportedLocalesEnum;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Landlord\UserFactory> */
    use Filterable, HasApiTokens, HasFactory, InteractsWithMedia, Notifiable,UsesLandlordConnection;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // current tenant
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'locale' => SupportedLocalesEnum::class,
        ];
    }

    public function generateToken(string $name = 'auth_token', array $abilities = ['*']): string
    {
        return $this->createToken($name, $abilities)->plainTextToken;
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
