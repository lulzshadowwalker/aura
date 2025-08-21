<?php

namespace App\Factories;

use App\Models\Cart;

class CartFactory
{
    protected static ?Cart $cached = null;

    public static function make(): Cart
    {
        if (self::$cached) {
            return self::$cached;
        }

        $attrs = auth()->guest()
            ? ['session_id' => session()->getId()]
            : ['customer_id' => auth()->user()->customer->id];

        // Try to get existing cart with relations
        $cart = Cart::query()
            ->where($attrs)
            ->with(['cartItems.product'])
            ->first();

        if (! $cart) {
            $cart = Cart::create($attrs);
        }

        // Ensure relations are loaded without extra duplicate queries later
        $cart->loadMissing(['cartItems.product']);

        return self::$cached = $cart;
    }
}
