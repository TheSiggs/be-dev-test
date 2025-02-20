<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageLimit = config('api.page_limit');
        $perPage = $request->query("per_page", $pageLimit);

        if (!is_numeric($perPage) || $perPage > $pageLimit) {
            $perPage = $pageLimit;
        }

        return response()->json(Customer::simplePaginate($perPage), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json("Boobs", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return response()->json("Boobs", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return response()->json("Boobs", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return response()->json("Boobs", 200);
    }
}
