@props(['product', 'collection'])
<a href="{{ route('products.show', $product->slug) }}">
    <div class="card bg-base-100 border border-neutral-300 aspect-square">
        <div class="card-body flex items-center justify-center bg-gray-200 group relative"
            x-data="{ imgSrc: (() => {
                switch ('{{ addslashes($product->name) }}') {
                    case 'Layaly': return 'https://i.imgur.com/8YKjZsa.png';
                    case 'Desire': return 'https://i.imgur.com/n9GsysZ.png';
                    case 'Asrar': return 'https://i.imgur.com/5e3h1Ol.png';
                    case 'Prestige': return 'https://i.imgur.com/5aiNy9a.png';
                    default: return 'https://png.pngtree.com/png-vector/20240202/ourmid/pngtree-perfume-bottle-mockup-cutout-png-file-png-image_11588760.png';
                }
            })() }">
            <img :src="imgSrc" alt="{{ $product->name }} Perfume Bottle" class="max-h-48 object-contain transition-transform duration-700 ease-in-out group-hover:-rotate-y-15 scale-160 -translate-y-6" style="transform-style: preserve-3d;" />

            <!-- NOTE: A product may belong to multiple collections so using only the the product id is not guaranteed to be unique. -->
            <form id="js-favorite-{{ isset($collection) ? 'c' . $collection->id . '-p' . $product->id : 'p-' . $product->id }}" x-target action="{{ route('favorites.store') }}" method="post" class="absolute top-0 end-0 p-2 tooltip" data-tip="{{ $product->isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @csrf
                <button class="btn btn-sm btn-circle group" aria-label="Add to Favorites">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" @class(["w-4 h-4 text-[#1a1a1a]/90", "text-red-400" => $product->isFavorite ]) fill="currentColor">
                        <path d="M12 21s-6.716-5.684-8.485-7.455A5.5 5.5 0 0 1 12 4.5a5.5 5.5 0 0 1 8.485 9.045C18.716 15.316 12 21 12 21z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <div class="flex items-start justify-between mt-4">
        <div>
            <h4>{{ $product->name }}</h4>
            <p class="mt-1 font-light text-neutral-500 dark:text-neutral-400 tracking-wide line-clamp-3">{{ $product->description }}</p>
        </div>

        <span class="min-w-fit">
            $20.00
        </span>
    </div>
</a>
