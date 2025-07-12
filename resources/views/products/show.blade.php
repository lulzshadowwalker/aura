<x-layout title="{{ $product->name }} - Mystic Bloom">
    <div class="bg-base-100 text-base-content" x-data="productGallery()">
        <!-- Sale Countdown Banner -->
        <div class="bg-gradient-to-r from-primary to-secondary text-white py-4">
            <div class="container mx-auto px-4 text-center">
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-fire text-orange-300"></i>
                        <span class="font-medium">Limited Time Offer - 25% Off!</span>
                    </div>
                    <div class="flex gap-2 items-center">
                        <span class="text-sm opacity-90">Ends in:</span>
                        <div class="flex gap-1">
                            <div class="countdown font-mono text-sm bg-white/20 rounded px-2 py-1">
                                <span style="--value:2;" aria-live="polite" aria-label="2">2</span>
                            </div>
                            <span class="text-xs self-center">d</span>
                            <div class="countdown font-mono text-sm bg-white/20 rounded px-2 py-1">
                                <span style="--value:15;" aria-live="polite" aria-label="15">15</span>
                            </div>
                            <span class="text-xs self-center">h</span>
                            <div class="countdown font-mono text-sm bg-white/20 rounded px-2 py-1">
                                <span style="--value:42;" aria-live="polite" aria-label="42">42</span>
                            </div>
                            <span class="text-xs self-center">m</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 py-8 lg:py-16">

                <!-- Image Gallery -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-5 gap-4">
                        <!-- Thumbnail Column -->
                        <div class="col-span-1 space-y-3">
                            <template x-for="(image, index) in images" :key="index">
                                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer border-2 transition-all duration-300"
                                    :class="activeImageIndex === index ? 'border-primary shadow-lg' : 'border-gray-200 hover:border-gray-300'"
                                    @click="activeImageIndex = index"
                                    x-lightbox="image.url"
                                    x-lightbox:group="product-gallery">
                                    <img :src="image.thumb" :alt="`${productName} thumbnail ${index + 1}`"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                </div>
                            </template>
                        </div>

                        <!-- Main Image -->
                        <div class="col-span-4">
                            <div class="aspect-[4/5] bg-gray-50 rounded-xl overflow-hidden shadow-xl cursor-pointer group relative"
                                @click="openLightbox(activeImageIndex)">
                                <img :src="images[activeImageIndex].url" :alt="`${productName} main image`"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-300 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-expand text-white text-2xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="lg:col-span-5 flex flex-col justify-center">
                    <div class="space-y-6">
                        <!-- Header -->
                        <div>
                            <p class="text-sm font-light tracking-widest uppercase text-primary/80 mb-2">
                                {{ $product->category->name }}
                            </p>
                            <h1 class="text-4xl lg:text-5xl font-serif font-light text-gray-800 leading-tight">
                                {{ $product->name }}
                            </h1>
                        </div>

                        <!-- Rating & Reviews -->
                        <!-- <div class="flex items-center gap-4">
                            <div class="rating rating-sm">
                                @for ($i = 1; $i
                                <= 5; $i++)
                                    <input type="radio" class="mask mask-star-2 bg-orange-400"
                                    {{ $i <= 4 ? 'checked' : '' }} disabled />
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600">({{ $product->reviews->count() }} reviews)</span>
                        </div> -->

                        <!-- Description -->
                        <div class="prose prose-lg max-w-none text-gray-600 font-light leading-relaxed">
                            <p>{{ $product->description }}</p>
                        </div>

                        <!-- Fragrance Notes -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="font-medium text-gray-800 mb-3">Fragrance Notes</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm">
                                <div>
                                    <span class="font-medium text-primary">Top:</span>
                                    <p class="text-gray-600">Damask rose, White musk</p>
                                </div>
                                <div>
                                    <span class="font-medium text-primary">Heart:</span>
                                    <p class="text-gray-600">Violet</p>
                                </div>
                                <div>
                                    <span class="font-medium text-primary">Base:</span>
                                    <p class="text-gray-600">Cashmere woods</p>
                                </div>
                            </div>
                        </div>

                        <!-- Size/Variant Selection -->
                        <!-- <div x-data="{ selectedSize: '100ml', selectedPrice: 120.00 }">
                            <div class="flex justify-between items-baseline mb-4">
                                <h3 class="text-lg font-medium text-gray-800">Size</h3>
                                <div class="text-right">
                                    <span class="text-2xl line-through text-gray-400 mr-2">$160.00</span>
                                    <span class="text-3xl font-light text-primary" x-text="`$${selectedPrice.toFixed(2)}`"></span>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <button class="btn btn-outline flex-1"
                                    :class="selectedSize === '50ml' ? 'btn-primary' : ''"
                                    @click="selectedSize = '50ml'; selectedPrice = 90.00">
                                    50ml
                                </button>
                                <button class="btn btn-outline flex-1"
                                    :class="selectedSize === '100ml' ? 'btn-primary' : ''"
                                    @click="selectedSize = '100ml'; selectedPrice = 120.00">
                                    100ml
                                </button>
                                <button class="btn btn-outline flex-1"
                                    :class="selectedSize === '150ml' ? 'btn-primary' : ''"
                                    @click="selectedSize = '150ml'; selectedPrice = 180.00">
                                    150ml
                                </button>
                            </div>
                        </div> -->

                        <!-- Add to Cart -->
                        <div class="flex items-center gap-3">
                            <button class="btn btn-primary btn-lg flex-grow shadow-lg hover:shadow-xl transition-all duration-300">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Add to Bag
                            </button>
                            <button class="btn btn-outline btn-lg btn-square"
                                aria-label="Add to Favorites"
                                title="Add to Favorites">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>

                        <!-- Additional Info -->
                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-truck text-primary"></i>
                                <span>Free shipping over $75</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-undo text-primary"></i>
                                <span>30-day returns</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-certificate text-primary"></i>
                                <span>100% Authentic</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-gift text-primary"></i>
                                <span>Gift wrapping available</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Inquiries Section -->
        <div class="bg-gray-50/50 border-t border-gray-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <div class="text-center mb-8">
                    <h2 class="text-3xl lg:text-4xl font-serif text-gray-800 mb-2">Product Inquiries</h2>
                    <p class="text-gray-600 font-light">Your questions, answered with care.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @if ($product->productQuestions->count() > 0)
                    <div id="js-product-questions" class="card bg-base-100 shadow-sm border border-gray-200">
                        <div class="card-body">
                            <h3 class="text-xl font-medium mb-4 text-gray-800">Frequently Asked Questions</h3>

                            <div class="space-y-2">
                                @foreach ($product->productQuestions as $question)
                                <div class="collapse collapse-plus bg-gray-50 border border-gray-200">
                                    <input type="radio" name="faq-accordion" @checked($loop->first) />
                                    <div class="collapse-title font-medium text-gray-800">
                                        {{ $question->question }}
                                    </div>
                                    <div class="collapse-content">
                                        <div class="flex justify-between items-start gap-4">
                                            <p class="text-sm text-gray-600 {{ !$question->answer ? 'italic text-gray-500' : '' }}">
                                                {{ $question->answer ?? "Waiting for an answer..." }}
                                            </p>
                                            @if (!$question->answer)
                                            <button class="btn btn-sm btn-circle btn-ghost tooltip tooltip-left"
                                                data-tip="Notify me when answered">
                                                <i class="fas fa-bell text-primary"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card bg-base-100 shadow-sm border border-gray-200">
                        <div class="card-body">
                            <h3 class="text-xl font-medium mb-4 text-gray-800">Ask a Question</h3>
                            <form id="js-product-question-form"
                                x-target="js-product-questions js-product-question-form"
                                action="{{ route('products.questions.store', $product->slug) }}"
                                method="POST"
                                class="space-y-4">
                                @csrf
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Email</span>
                                    </label>
                                    <input name="email" type="email"
                                        placeholder="your@email.com"
                                        class="input input-bordered w-full validator"
                                        required
                                        value="{{ old('email', auth()->user()->email ?? '') }}" />
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Question</span>
                                    </label>
                                    <textarea name="question"
                                        class="textarea textarea-bordered h-24 w-full validator"
                                        placeholder="What would you like to know about this fragrance?"
                                        required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-full">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Submit Question
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-serif text-gray-800">Customer Reviews</h2>
                <button class="btn btn-primary btn-outline" onclick="review_modal.showModal()">
                    <i class="fas fa-star mr-2"></i>
                    Write a Review
                </button>
            </div>

            <div class="card bg-base-100 shadow-sm border border-gray-200">
                <div class="card-body">
                    <div class="space-y-6">
                        @forelse ($product->reviews->take(2) as $review)
                        <div class="flex gap-4 pb-6 border-b border-gray-200 last:border-b-0 last:pb-0">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-medium">
                                    {{ strtoupper(substr($review->customer->user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <h4 class="font-medium text-gray-800">{{ $review->customer->user->name }}</h4>
                                        <div class="rating rating-sm">
                                            @for ($i = 1; $i
                                            <= 5; $i++)
                                                <input type="radio" class="mask mask-star-2 bg-orange-400"
                                                {{ $i <= $review->rating ? 'checked' : '' }} disabled />
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $review->content }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <i class="fas fa-star text-gray-300 text-4xl mb-4"></i>
                            <p class="text-gray-500">No reviews yet. Be the first to share your experience!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Review Modal -->
        <dialog id="review_modal" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg mb-4">Write a Review</h3>
                <form x-data="{ rating: 0 }" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Rating</span>
                        </label>
                        <div class="rating rating-lg">
                            @for ($i = 1; $i
                            <= 5; $i++)
                                <input type="radio" name="rating"
                                class="mask mask-star-2 bg-orange-400"
                                value="{{ $i }}"
                                @click="rating = {{ $i }}"
                                aria-label="{{ $i }} stars" />
                            @endfor
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Your Review</span>
                        </label>
                        <textarea name="review"
                            class="textarea textarea-bordered h-24"
                            placeholder="Share your experience with this fragrance..."
                            required></textarea>
                    </div>
                    <div class="modal-action">
                        <button type="button" class="btn btn-ghost" onclick="review_modal.close()">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-star mr-2"></i>
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </dialog>

        <!-- You May Also Like Section -->
        @php
            $otherProducts = [
                ['name' => 'Layaly', 'image' => 'https://i.imgur.com/8YKjZsa.png', 'type' => 'Eau de Toilette', 'price' => 85],
                ['name' => 'Desire', 'image' => 'https://i.imgur.com/n9GsysZ.png', 'type' => 'Eau de Parfum', 'price' => 150],
                ['name' => 'Asrar', 'image' => 'https://i.imgur.com/5e3h1Ol.png', 'type' => 'Eau de Cologne', 'price' => 70],
                ['name' => 'Prestige', 'image' => 'https://i.imgur.com/5aiNy9a.png', 'type' => 'Extrait de Parfum', 'price' => 220],
            ];
        @endphp
        <div class="bg-white border-t border-gray-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <div class="text-center mb-8">
                    <h2 class="text-3xl lg:text-4xl font-serif text-gray-800 mb-2">Discover Other Essences</h2>
                    <p class="text-gray-600 font-light">Curated selections just for you</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($otherProducts as $product)
                    <div class="group cursor-pointer">
                        <div class="bg-gray-100 rounded-lg overflow-hidden mb-4 aspect-square">
                            <img src="{{ $product['image'] }}"
                                alt="{{ $product['name'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="text-center">
                            <h4 class="font-medium text-gray-800 mb-1">{{ $product['name'] }}</h4>
                            <p class="text-sm text-gray-500 mb-2">{{ $product['type'] }}</p>
                            <p class="font-medium text-gray-900">${{ $product['price'] }}.00</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function productGallery() {
            const galleries = {
                'Layaly': [
                    {
                        url: 'https://i.imgur.com/8YKjZsa.png',
                        thumb: 'https://i.imgur.com/8YKjZsa.png'
                    }
                ],
                'Desire': [
                    {
                        url: 'https://i.imgur.com/n9GsysZ.png',
                        thumb: 'https://i.imgur.com/n9GsysZ.png'
                    }
                ],
                'Asrar': [
                    {
                        url: 'https://i.imgur.com/5e3h1Ol.png',
                        thumb: 'https://i.imgur.com/5e3h1Ol.png'
                    }
                ],
                'Prestige': [
                    {
                        url: 'https://i.imgur.com/5aiNy9a.png',
                        thumb: 'https://i.imgur.com/5aiNy9a.png'
                    }
                ]
            };

            const defaultImages = [
                {
                    url: 'https://images.unsplash.com/photo-1514557179557-9efc4d7949cc?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0',
                    thumb: 'https://images.unsplash.com/photo-1514557179557-9efc4d7949cc?q=80&w=300&auto=format&fit=crop&ixlib=rb-4.1.0'
                },
                {
                    url: 'https://images.unsplash.com/photo-1563170351-be82bc888aa4?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0',
                    thumb: 'https://images.unsplash.com/photo-1563170351-be82bc888aa4?q=80&w=300&auto=format&fit=crop&ixlib=rb-4.1.0'
                },
                {
                    url: 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0',
                    thumb: 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=300&auto=format&fit=crop&ixlib=rb-4.1.0'
                },
                {
                    url: 'https://images.unsplash.com/photo-1514557179557-9efc4d7949cc?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0',
                    thumb: 'https://images.unsplash.com/photo-1514557179557-9efc4d7949cc?q=80&w=300&auto=format&fit=crop&ixlib=rb-4.1.0'
                }
            ];

            const productName = '{{ is_array($product) ? $product['name'] : $product->name }}';

            return {
                activeImageIndex: 0,
                productName,
                images: galleries[productName] || defaultImages
            }
        }
    </script>
</x-layout>
