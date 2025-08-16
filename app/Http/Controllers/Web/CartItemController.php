<?php

namespace App\Http\Controllers\Web;

use App\Actions\AddProductToCart;
use App\Actions\DecrementCartItem;
use App\Actions\RemoveCartItem;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;

class CartItemController extends Controller
{
    public function __construct()
    {
        //
    }

    public function store(string $language, Product $product)
    {
        AddProductToCart::make()->execute($product);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function increment(string $language, CartItem $cartItem)
    {
        AddProductToCart::make()->execute($cartItem->product);

        return redirect()->back();
    }

    public function decrement(string $language, CartItem $cartItem)
    {
        DecrementCartItem::make()->execute($cartItem);

        return redirect()->back();
    }

    public function destroy(string $language, CartItem $cartItem)
    {
        RemoveCartItem::make()->execute($cartItem);

        return redirect()->back()->with('success', 'Item removed from cart successfully.');
    }
}
