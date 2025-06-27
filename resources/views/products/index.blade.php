<x-layout title="All Perfumes - Perfume Store">
    <section class="py-12">
        <div class="container mx-auto px-4">
            <header class="text-center mb-12">
                <h1 class="text-4xl lg:text-5xl font-light tracking-wide mb-4">Our Perfume Collection</h1>
                <p class="text-lg text-base-content/70 max-w-3xl mx-auto">
                    Discover our exquisite range of luxury fragrances, each crafted to captivate your senses
                </p>
            </header>

            <div class="flex flex-wrap gap-4 justify-center mb-8">
                @foreach($collections as $collection)
                    <a
                        href="{{ route('collections.show', $collection->slug) }}"
                        class="btn btn-outline btn-lg"
                    >
                        {{ $collection->name }}
                    </a>
                @endforeach
            </div>

            @if($products->isEmpty())
                <div class="text-center py-16">
                    <i data-lucide="package-x" class="w-24 h-24 mx-auto text-base-content/20 mb-4"></i>
                    <p class="text-xl text-base-content/60">No products available at the moment.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                @if($products->hasPages())
                    <nav class="mt-12 flex justify-center" aria-label="Pagination">
                        {{ $products->links() }}
                    </nav>
                @endif
            @endif
        </div>
    </section>

    <section class="py-12 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-light tracking-wide mb-6">The Art of Fragrance</h2>
                <p class="text-base-content/70 mb-8">
                    Each of our perfumes is a masterpiece, blending the finest ingredients from around the world.
                    Whether you're seeking a signature scent or the perfect gift, our collection offers something
                    extraordinary for every occasion.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('collections.show', 'luxury-perfumes') }}" class="btn btn-primary btn-lg">
                        <i data-lucide="sparkles" class="w-5 h-5"></i>
                        Explore Luxury Collection
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn btn-outline btn-lg">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        Get Recommendations
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
