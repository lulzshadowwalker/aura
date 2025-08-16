<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductQuestionRequest;
use App\Models\Product;

class ProductQuestionController extends Controller
{
    public function store(string $language, StoreProductQuestionRequest $request, Product $product)
    {
        $product->productQuestions()->create([
            ...$request->validated(),
            'customer_id' => auth()->id(),
        ]);

        return redirect()
            ->route('products.show', ['product' => $product->slug, 'language' => $language])
            ->with('success', 'Question submitted successfully, we will get back to you soon.');
    }
}
