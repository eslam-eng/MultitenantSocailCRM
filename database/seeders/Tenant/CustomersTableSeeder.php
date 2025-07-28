<?php

namespace Database\Seeders\Tenant;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(50)->forTenant(Tenant::first()->id)->create();
    }
}
