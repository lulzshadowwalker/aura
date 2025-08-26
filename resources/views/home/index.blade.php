<x-layout>
    {{-- Hero --}}
    <section class="hero min-h-screen relative overflow-hidden">
        <video class="absolute inset-0 w-full h-full object-cover" src="{{ asset('assets/videos/hero.mp4') }}" autoplay
            loop muted playsinline></video>
        <div class="bg-gradient-to-t from-black/60 to-black/0 absolute inset-0 z-10"></div>
        <div class="text-neutral-content text-center relative z-10">
            <div class="max-w-md mx-auto">
                <h1 class="mb-5 text-5xl font-bold drop-shadow-lg">
                    {{ __('app.a-breeze-of-luxury') }}
                </h1>
                <p class="mb-5 drop-shadow-lg">
                    {{ __('app.hero-description') }}
                </p>
                <a href="#collections" class="btn btn-primary btn-lg shadow-lg">{{ __('app.get-started') }}</a>
            </div>
        </div>
    </section>

    {{-- About North Wind --}}
    <section class="py-18 bg-gradient-to-b from-base-100 to-base-200 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-4">
                    <div class="inline-flex items-center gap-4 mb-6">
                        <div class="w-12 lg:w-16 h-px bg-gradient-to-r from-transparent to-primary"></div>
                        <h2 class="text-2xl tracking-[0.2em] uppercase text-base-content sr-only">
                            {{ __('app.about-north-wind') }}
                        </h2>

                        <img src="{{ asset('assets/images/logo.png') }}" alt="{{ __('app.about-north-wind') }}"
                            class="w-24 lg:w-32" />
                        <div class="w-12 lg:w-16 h-px bg-gradient-to-l from-transparent to-primary"></div>
                    </div>
                </div>

                <!-- Brand Story Content -->
                <div class="max-w-4xl mx-auto">
                    <div class="space-y-8">
                        <p class="text-lg leading-relaxed text-base-content/90 font-light tracking-wider text-center">
                            {{ __('app.brand-story') }}
                        </p>

                        <!-- Decorative Quote -->
                        <div class="relative ps-8 lg:ps-12 max-w-3xl mx-auto">
                            <div
                                class="absolute start-0 top-0 w-1 h-full bg-gradient-to-b from-primary to-primary/20 rounded-full">
                            </div>
                            <p class="text-xl italic text-primary font-medium leading-relaxed tracking-wide">
                                {{ __('app.brand-story-tagline') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bottom Decorative Line -->
                <div class="flex justify-center mt-16 lg:mt-20">
                    <div
                        class="w-24 lg:w-32 h-px bg-gradient-to-r from-transparent via-primary to-transparent opacity-50">
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Decorative Elements -->
        <div class="absolute top-10 left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-primary/3 rounded-full blur-3xl"></div>
    </section>

    {{-- Collections --}}
    <div id="collections" class="container mx-auto px-4 my-12 max-md:my-8">
        <h2 class="sr-only">{{ __('app.our-collections') }}</h2>
        @foreach ($collections as $collection)
            <section id="{{ $collection->slug }}" class="mb-16 last:mb-0">
                <header class="mb-8">
                    <h3 class="text-3xl lg:text-4xl font-light tracking-wide mb-2">{{ $collection->name }}</h3>
                    <p class="text-lg text-base-content/70">{{ $collection->description }}</p>
                </header>

                @if ($collection->products->isNotEmpty())
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                        @foreach ($collection->products as $product)
                            <x-product-card :product="$product" :collection="$collection" :cart="$cart" />
                        @endforeach
                    </div>

                    <a href="{{ route('collections.show', ['collection' => $collection->slug, 'language' => app()->getLocale()]) }}"
                        class="link link-hover flex items-center justify-end gap-1">
                        {{ trans('app.view-all', ['name' => $collection->name]) }}
                        <i data-lucide="move-right" class="w-5 h-5 rtl:rotate-180"></i>
                    </a>
                @else
                    <div class="text-center py-12">
                        <p class="text-base-content/60">{{ __('app.no-products-in-collection') }}</p>
                    </div>
                @endif
            </section>

            @if (!$loop->last && $loop->iteration <= 3)
                <div class="my-16">
                    <x-banner-card :image="asset('assets/images/sample-' . ((($loop->iteration - 1) % 3) + 1) . '.webp')" />
                </div>
            @endif
        @endforeach
    </div>
</x-layout>
