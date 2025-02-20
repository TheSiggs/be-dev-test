<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers');
    }

    public function getCustomers(Request $request)
    {
        $pageLimit = config('api.page_limit');
        $perPage = $request->query("per_page", $pageLimit);

        if (!is_numeric($perPage) || $perPage > $pageLimit) {
            $perPage = $pageLimit;
        }
        $customers = Customer::paginate($perPage);

        return view('partials.customer-list', compact('customers', 'perPage'));
    }
}
