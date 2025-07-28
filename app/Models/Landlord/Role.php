<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class Role extends \Spatie\Permission\Models\Role
{
    use UsesLandlordConnection;
}
