<x-layout>
    {{-- Hero --}}
    <section class="hero min-h-screen relative overflow-hidden">
        <video
            class="absolute inset-0 w-full h-full object-cover"
            src="{{ asset('assets/videos/hero.mp4') }}"
            autoplay
            loop
            muted
            playsinline
        ></video>
        <div class="bg-gradient-to-t from-black/60 to-black/0 absolute inset-0 z-10"></div>
        <div class="text-neutral-content text-center relative z-10">
            <div class="max-w-md mx-auto">
                <h1 class="mb-5 text-5xl font-bold drop-shadow-lg">
                    {{ __('app.a-breeze-of-luxury') }}
                </h1>
                <p class="mb-5 drop-shadow-lg">
                    {{ __('app.hero-description') }}
                </p>
                <button class="btn btn-primary btn-lg shadow-lg">{{ __('app.get-started') }}</button>
            </div>
        </div>
    </section>

    {{-- Collections --}}
    <div class="container mx-auto px-4 my-12 max-md:my-8">
        <h2 class="sr-only">Our Collections</h2>
        @foreach ($collections as $collection)
            <section id="{{ $collection->slug }}" class="mb-16 last:mb-0">
                <header class="mb-8">
                    <h3 class="text-3xl lg:text-4xl font-light tracking-wide mb-2">{{ $collection->name }}</h3>
                    <p class="text-lg text-base-content/70">{{ $collection->description }}</p>
                </header>

                @if($collection->products->isNotEmpty())
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                        @foreach($collection->products->take(4) as $product)
                            <x-product-card :product="$product" :collection="$collection"/>
                        @endforeach
                    </div>

                    @if($collection->products->count() > 4)
                        <a href="{{ route('collections.show', ['collection' => $collection->slug, 'language' => app()->getLocale()]) }}"
                           class="link link-hover flex items-center justify-end gap-1">
                            {{ trans('app.view-all', ['name' => $collection->name]) }}
                            <i data-lucide="move-right" class="w-5 h-5 rtl:rotate-180"></i>
                        </a>
                    @endif
                @else
                    <div class="text-center py-12">
                        <p class="text-base-content/60">No products available in this collection yet.</p>
                    </div>
                @endif
            </section>

            @if(!$loop->last)
                <div class="my-16">
                    <x-banner-card :image="asset('assets/images/sample-' . ($loop->iteration % 3 + 1) . '.jpeg')"/>
                </div>
            @endif
        @endforeach
    </div>
</x-layout>

