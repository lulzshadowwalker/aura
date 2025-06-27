<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoriteRequest;

class FavoriteController extends Controller
{
    public function store(StoreFavoriteRequest $request)
    {
        //  TODO: Session and Customer favorites
        //  TODO: MigrateSessionFavoritesAction
        $customer = \App\Models\Customer::first();

        $exists = $customer
            ->favorites()
            ->where("product_id", $request->product_id)
            ->exists();

        if ($exists) {
            $customer
                ->favorites()
                ->where("product_id", $request->product_id)
                ->delete();

            return redirect()
                ->back()
                ->with("success", "Product removed from favorites");
        }

        $customer->favorites()->create([
            "product_id" => $request->product_id,
        ]);

        return redirect()
            ->back()
            ->with("success", "Product added to favorites");
    }
}
