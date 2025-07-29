<?php

namespace App\Models\Landlord;

use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class Role extends \Spatie\Permission\Models\Role
{
    use UsesLandlordConnection;
}
