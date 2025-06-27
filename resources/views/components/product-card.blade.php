@props(['product'])
<a href="{{ route('products.show', $product->id) }}">
    <div class="card bg-base-100 border border-neutral-300 aspect-square">
        <div class="card-body flex items-center justify-center bg-gray-200 group relative">
            <img src="https://png.pngtree.com/png-vector/20240202/ourmid/pngtree-perfume-bottle-mockup-cutout-png-file-png-image_11588760.png" alt="{{ $product->name }} Perfume Bottle" class="max-h-48 object-contain transition-transform duration-700 ease-in-out group-hover:-rotate-y-15" style="transform-style: preserve-3d;" />

            <div class="absolute top-0 end-0 p-2 tooltip" data-tip="Add to Favorites">
                <button class="btn btn-sm btn-circle btn-outline btn-primary group" aria-label="Add to Favorites">
                    <i data-lucide="heart" class="w-4 h-4 text-primary transition-colors duration-300 group-hover:text-red-400" fill="currentColor"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="flex items-start justify-between mt-4">
        <div>
            <h4>{{ $product->name }}</h4>
            <p class="mt-1 font-light text-neutral-500 dark:text-neutral-400 tracking-wide">{{ $product->description }}</p>
        </div>

        <span class="min-w-fit">
            $20.00
        </span>
    </div>
</a>
