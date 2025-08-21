<?php

namespace App\Http\Controllers;

use App\Factories\CartFactory;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HomeController extends Controller
{
    public function index()
    {
        $customerId = auth()->user()?->customer->id;

        $collections = Collection::query()->withCount('products')
            ->with([
                'products' => function (BelongsToMany $q) use ($customerId) {
                    $q->with('media')
                        // Precompute favorite flag for the current customer (Laravel 9+: withExists)
                        ->when($customerId, fn ($qq) => $qq->withExists([
                            'favorites as isFavorite' => fn ($q3) => $q3->where('customer_id', $customerId),
                        ]))
                        ->when($customerId, fn ($qq) => $qq->with(['favorites' => fn ($qf) => $qf->where('customer_id', $customerId)]));
                },
            ])
            ->get();

        $cart = CartFactory::make();

        return view('home.index', compact('collections', 'cart'));
    }
}
