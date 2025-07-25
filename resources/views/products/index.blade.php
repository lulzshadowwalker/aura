<x-layout title="All Perfumes - Perfume Store">
    <div class="container mx-auto px-4 my-12">
        <header class="mb-8">
            <h1 class="text-3xl lg:text-4xl font-light tracking-wide mb-2">All Products</h1>
            <p class="text-lg text-base-content/70">Discover our exclusive collection of perfumes.</p>
        </header>

        <div class="mb-8 flex justify-between items-center">
            <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2">
                <div class="form-control">
                    <input type="text" name="search" placeholder="Search by name" class="input input-bordered w-full max-w-xs" value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <form action="{{ route('products.index') }}" method="GET">
                <div class="form-control">
                    <select name="sort" class="select select-bordered" onchange="this.form.submit()">
                        <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>Sort by</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                    </select>
                </div>
                <input type="hidden" name="search" value="{{ request('search') }}">
            </form>
        </div>

        @if($products->isNotEmpty())
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-base-content/60">No products found.</p>
            </div>
        @endif
    </div>
</x-layout>

