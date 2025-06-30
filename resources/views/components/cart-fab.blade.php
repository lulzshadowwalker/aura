<div x-data="{ cartOpen: false }" @keydown.escape.window="cartOpen = false">
    <!-- Cart FAB -->
    <div class="fixed bottom-6 right-6 z-40">
        <button @click="cartOpen = true" class="btn btn-primary btn-circle shadow-lg" aria-label="Open cart">
            <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            <!-- Cart count -->
            <div class="badge badge-secondary absolute -top-1 -right-1">3</div>
        </button>
    </div>

    <!-- Overlay -->
    <div x-show="cartOpen"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-50"
         @click="cartOpen = false"
         style="display: none;">
    </div>

    <!-- Slide-over Cart -->
    <div
        x-show="cartOpen"
        x-trap.inert.noscroll="cartOpen"
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 w-full max-w-md bg-base-100 shadow-xl z-50 flex flex-col"
        style="display: none;"
        aria-labelledby="slide-over-title"
        role="dialog"
        aria-modal="true"
    >
        <!-- Header -->
        <header class="flex items-center justify-between p-6 border-b border-base-300">
            <h2 id="slide-over-title" class="text-2xl font-light tracking-wide text-base-content">Your Bag</h2>
            <button @click="cartOpen = false" class="btn btn-ghost btn-circle" aria-label="Close cart">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </header>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6">
            <!-- Sample Cart Item 1 -->
            <div class="flex items-start space-x-4">
                <img src="https://png.pngtree.com/png-vector/20240202/ourmid/pngtree-perfume-bottle-mockup-cutout-png-file-png-image_11588760.png" alt="Perfume Bottle" class="w-24 h-24 object-cover rounded-lg border border-base-300">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-base-content">Mystic Bloom</h3>
                    <p class="text-sm font-light text-neutral-500">Eau de Parfum - 50ml</p>
                    <p class="text-lg font-bold text-base-content mt-2">$120.00</p>
                </div>
                <div class="flex flex-col items-end justify-between h-24">
                     <button class="tooltip tooltip-left text-error/70 hover:text-error" data-tip="Remove item">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                    <div class="flex items-center space-x-3">
                        <button class="btn btn-ghost btn-xs" aria-label="Decrease quantity">-</button>
                        <span class="text-md font-semibold">1</span>
                        <button class="btn btn-ghost btn-xs" aria-label="Increase quantity">+</button>
                    </div>
                </div>
            </div>

            <!-- Sample Cart Item 2 -->
            <div class="flex items-start space-x-4">
                <img src="https://png.pngtree.com/png-vector/20240202/ourmid/pngtree-perfume-bottle-mockup-cutout-png-file-png-image_11588760.png" alt="Perfume Bottle" class="w-24 h-24 object-cover rounded-lg border border-base-300">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-base-content">Ocean Breeze</h3>
                    <p class="text-sm font-light text-neutral-500">Eau de Toilette - 100ml</p>
                    <p class="text-lg font-bold text-base-content mt-2">$85.00</p>
                </div>
                 <div class="flex flex-col items-end justify-between h-24">
                     <button class="tooltip tooltip-left text-error/70 hover:text-error" data-tip="Remove item">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                    <div class="flex items-center space-x-3">
                        <button class="btn btn-ghost btn-xs" aria-label="Decrease quantity">-</button>
                        <span class="text-md font-semibold">2</span>
                        <button class="btn btn-ghost btn-xs" aria-label="Increase quantity">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="p-6 border-t border-base-300">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-light text-base-content">Subtotal</span>
                <span class="text-xl font-bold text-base-content">$290.00</span>
            </div>
            <a href="/checkout" class="btn btn-primary w-full">
                Proceed to Checkout
            </a>
             <div class="text-center mt-4">
                <button @click="cartOpen = false" class="link link-hover text-sm text-base-content/70">or Continue Shopping</button>
            </div>
        </footer>
    </div>
</div>