<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $collections = Collection::all();
        $customer = \App\Models\Customer::first();
        $user = auth()->login($customer->user);
        return view("home.index", compact("collections"));
    }
}
