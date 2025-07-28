<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $activeFeature = Feature::factory()
            ->count(5)
            ->feature()
            ->active()
            ->create();

        // Create multiple features
        $features = Feature::factory()
            ->count(3)
            ->limit()
            ->active()
            ->create();

    }
}
