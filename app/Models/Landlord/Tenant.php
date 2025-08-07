<?php

namespace App\Models\Landlord;

use App\Traits\HasFeatureLimits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Tenant extends \Spatie\Multitenancy\Models\Tenant
{
    use HasFeatureLimits,SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'database', 'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tenant_users')
            ->withPivot('is_owner')
            ->withTimestamps()
            ->using(TenantUser::class);

    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    // Get owner user directly through pivot
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')
            ->join('tenant_users', 'users.id', '=', 'tenant_users.user_id')
            ->where('tenant_users.tenant_id', $this->id)
            ->where('tenant_users.is_owner', true);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($tenant) {
            // Generate database name if not provided
            if (empty($tenant->database)) {
                $ulid = (string) Str::ulid(); // e.g., '01HZG8Z8X1CWVRYKX84Z7KT8AZ'
                $lastFive = substr($ulid, -5); // e.g., '8AZ'
                $tenant->database = 'tenant_'.Str::slug($tenant->name).'_'.$lastFive;
            }
        });

        static::created(function ($tenant) {
            if (app()->environment('local')) {
                // Create the tenant database
                static::createDatabase($tenant->database);
                $tenant->makeCurrent();
                // Run migrations for the tenant
                Artisan::call('migrate:fresh', [
                    '--database' => 'tenant',
                    '--force' => true,
                    '--seed' => true,
                ]);
            }
        });

    }

    public function latestSubscription()
    {
        return $this->hasOne(Subscription::class)->latestOfMany(); // latest active
    }

    public function activeSubscriptions(): Builder|HasMany
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('starts_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>', now());
            });
    }

    public static function createDatabase($database_name): bool
    {
        return DB::statement("CREATE DATABASE IF NOT EXISTS `$database_name`");
    }
}
