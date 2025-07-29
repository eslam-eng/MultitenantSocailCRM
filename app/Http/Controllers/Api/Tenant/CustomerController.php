<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return response()->json($customers);
    }

    public function store()
    {
        dd(auth()->user());
        Customer::create([
            'name' => 'created from request',
        ]);

        return response()->json(['message' => 'created']);
    }
}
