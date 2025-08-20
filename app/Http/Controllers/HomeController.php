<?php

namespace App\Http\Controllers;

use App\Factories\CartFactory;
use App\Models\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $collections = Collection::all();
        $cart = CartFactory::make();

        return view('home.index', compact('collections', 'cart'));
    }
}
