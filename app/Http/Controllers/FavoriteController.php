<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoriteRequest;

class FavoriteController extends Controller
{
    public function store(string $language, StoreFavoriteRequest $request)
    {
        //  TODO: Session and Customer favorites
        //  TODO: MigrateSessionFavoritesAction
        $customer = auth()->user()?->customer;

        if (! $customer) {
            //  TODO: Remove this, we should allow guests to add products to favorites
            return redirect()
                ->back()
                ->with('warning', __('app.please-login-to-favorite'));
        }

        $exists = $customer
            ->favorites()
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            $customer
                ->favorites()
                ->where('product_id', $request->product_id)
                ->delete();

            return redirect()
                ->back()
                ->with('success', __('app.product-removed-from-favorites'));
        }

        $customer->favorites()->create([
            'product_id' => $request->product_id,
        ]);

        return redirect()
            ->back()
            ->with('success', __('app.product-added-to-favorites'));
    }
}
