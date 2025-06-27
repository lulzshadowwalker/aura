<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $collections = Collection::all();
        return view("home.index", compact("collections"));
    }
}
