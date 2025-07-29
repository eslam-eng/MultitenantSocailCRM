<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Tenant extends \Spatie\Multitenancy\Models\Tenant
{
    use SoftDeletes;

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
            // Create the tenant database
            static::createDatabase($tenant->database);
            $tenant->makeCurrent();
            // Run migrations for the tenant
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--force' => true,
            ]);
        });

    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latestOfMany(); // latest active
    }

    public static function createDatabase($database_name): bool
    {
        return DB::statement("CREATE DATABASE IF NOT EXISTS `$database_name`");
    }
}
