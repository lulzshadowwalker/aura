<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoriteRequest;

class FavoriteController extends Controller
{
    public function store(StoreFavoriteRequest $request)
    {
        //  TODO: Session and Customer favorites
        //  TODO: MigrateSessionFavoritesAction
        $customer = auth()->user()?->customer;

        if (! $customer) {
            //  TODO: Remove this, we should allow guests to add products to favorites
            return redirect()
                ->back()
                ->with("warning", "Please login to add products to favorites");
        }

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
