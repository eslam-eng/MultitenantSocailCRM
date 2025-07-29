<?php

use Illuminate\Support\Collection;

if (! function_exists('countriesData')) {
    function countriesData(): Collection
    {
        // Load your JSON file (stored in storage or resources)
        $jsonPath = database_path('top_100_country_phone_codes.json'); // example path
        $countries = json_decode(file_get_contents($jsonPath), true);

        return collect($countries);
    }
}
