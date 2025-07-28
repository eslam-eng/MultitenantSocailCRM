<?php

namespace Database\Seeders;

use App\Models\Landlord\Tenant;
use Database\Seeders\Landlord\TenantsTableSeeder;
use Database\Seeders\Landlord\UsersTableSeeder;
use Database\Seeders\Tenant\CustomersTableSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::checkCurrent()
            ? $this->runTenantSpecificSeeders()
            : $this->runLandlordSpecificSeeders();
    }

    public function runTenantSpecificSeeders(): void
    {
        $this->call(CustomersTableSeeder::class);
        $this->call(\Database\Seeders\Tenant\UsersTableSeeder::class);
    }

    public function runLandlordSpecificSeeders(): void
    {
        $this->call(TenantsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
