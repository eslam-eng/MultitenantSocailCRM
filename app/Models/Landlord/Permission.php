<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class Permission extends \Spatie\Permission\Models\Permission
{
    use UsesLandlordConnection;
}
