@props(['product', 'collection', 'cart'])
<a href="{{ route('products.show', ['product' => $product->slug, 'language' => app()->getLocale()]) }}">
    <div class="card aspect-square">
        <div class="card-body flex items-center justify-center group relative">
            <img src="{{ $product->getFirstMediaUrl('product.cover', 'thumb') }}"
                srcset="{{ $product->getFirstMedia('product.cover')?->getSrcset('thumb') }}"
                sizes="(min-width: 440px) 264px, calc(50vw - 80px)" alt="{{ $product->name }} Perfume Bottle"
                class="max-h-70 object-contain transition-transform duration-700 ease-in-out group-hover:-rotate-y-15"
                style="transform-style: preserve-3d;" />

            @php
                $id =
                    'js-product-card-cart-actions-' .
                    (isset($collection) ? 'c' . $collection->id . '-p' . $product->id : 'p-' . $product->id);
            @endphp
            <div id="{{ $id }}" class="absolute top-2 end-2 flex flex-col items-center gap-1">
                <form x-target="{{ $id }}"
                    action="{{ route('favorites.store', ['language' => app()->getLocale()]) }}" method="post"
                    class="tooltip"
                    data-tip="{{ $product->isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @csrf
                    <button class="btn btn-sm btn-circle group" aria-label="Add to Favorites">
                        <i @class([
                            'fa fa-heart text-[#1a1a1a]/90',
                            'text-red-400' => $product->isFavorite,
                        ])></i>
                    </button>
                </form>

                <div class="divider !my-0"></div>

                @php $cartItem = $cart->cartItem($product); @endphp

                <form x-target="js-cart-fab js-cart-slideover {{ $id }}"
                    action="{{ $cartItem ? route('cart.items.increment', ['cartItem' => $cartItem->id, 'language' => app()->getLocale()]) : route('cart.items.add', ['product' => $product->slug, 'language' => app()->getLocale()]) }}"
                    method="post" class="tooltip" data-tip="Add to Cart">
                    @csrf
                    <button class="btn btn-sm btn-circle" aria-label="Add to Cart">
                        <i class="fa fa-plus"></i>
                    </button>
                </form>

                @if ($cartItem)
                    <div class="btn btn-sm btn-secondary btn-circle btn-disabled text-black">
                        {{ $cartItem->quantity }}
                    </div>

                    <form x-target="js-cart-fab js-cart-slideover {{ $id }}"
                        action="{{ !$cartItem->last ? route('cart.items.decrement', ['cartItem' => $cartItem->id, 'language' => app()->getLocale()]) : route('cart.items.remove', ['cartItem' => $cartItem->id, 'language' => app()->getLocale()]) }}"
                        method="post" class="tooltip tooltip-bottom"
                        data-tip="{{ $cartItem->last ? 'Delete from Cart' : 'Decrease from Cart' }}">
                        @csrf
                        @method($cartItem->last ? 'delete' : 'post')
                        <button @class(['btn btn-sm btn-circle', 'btn-error' => true])
                            aria-label="{{ $cartItem->last ? 'Delete from Cart' : 'Decrease from Cart' }}">
                            <i @class(['fa fa-minus', 'fa fa-trash' => $cartItem->last])></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="flex items-start justify-between mt-4">
        <div>
            <h4 class="_font-zain rtl:text-xl">{{ $product->name }}</h4>
            <p class="mt-1 font-light text-neutral-500 dark:text-neutral-400 tracking-wide line-clamp-3">
                {{ $product->description }}</p>
        </div>

        <span class="min-w-fit flex items-center">
            {{ $product->price->getAmount() }} <x-sar />
        </span>
    </div>
</a>
