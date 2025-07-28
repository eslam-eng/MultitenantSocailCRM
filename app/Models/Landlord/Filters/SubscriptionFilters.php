<?php

namespace App\Models\Landlord\Filters;

use App\Abstracts\QueryFilter;

class SubscriptionFilters extends QueryFilter
{
    public function __construct($params = [])
    {
        parent::__construct($params);
    }
}
