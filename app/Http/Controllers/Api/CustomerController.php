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
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:customers,email|max:255',
            'gender' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:2048',
        ]);

        $validated['ip_address'] = $request->ip();
        $customer = Customer::create($validated);

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => 'Invalid id'], 400);
        }

        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        return response()->json($customer, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => 'Invalid id'], 400);
        }

        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customers,email|max:255',
            'gender' => 'sometimes|string|max:255',
            'company' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'website' => 'sometimes|url|max:2048',
        ]);

        $validated['ip_address'] = $request->ip();

        $customer->update($validated);

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => 'Invalid id'], 400);
        }

        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted'], 200);
    }
}
