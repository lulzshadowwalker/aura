<?php

namespace App\Http\Controllers;

use App\Factories\CartFactory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($request->input('search')).'%']);
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort === 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort === 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        }

        $products = $query->get();
        $cart = CartFactory::make();

        return view('products.index', compact('products', 'cart'));
    }

    public function show(string $language, Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        $cart = CartFactory::make();

        return view('products.show', compact('product', 'relatedProducts', 'cart'));
    }
}
