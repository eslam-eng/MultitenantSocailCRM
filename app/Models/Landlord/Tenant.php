<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\SoftDeletes;
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
        return $this->belongsToMany(User::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($tenant) {
            // Generate database name if not provided
            if (empty($tenant->database)) {
                $tenant->database = 'tenant_'.Str::slug($tenant->name).'_'.time();
            }
        });

        static::created(function ($tenant) {
            // Create the tenant database
            static::createDatabase($tenant->database);
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
