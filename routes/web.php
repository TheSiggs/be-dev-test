<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CustomerController;

Route::get('/', [CustomerController::class, 'index']);
Route::get('/customers/list', [CustomerController::class, 'getCustomers']);
