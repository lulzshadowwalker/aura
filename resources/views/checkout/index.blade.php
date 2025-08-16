<x-layout>
    <div class="min-h-screen bg-base-100 py-8" x-data="{ paymentMethod: null }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Aura Logo" class="w-10 h-10 rounded-full">
                    <h1 class="text-2xl font-bold text-gray-900">Your Order</h1>
                </div>
            </div>

            @if($cart && !$cart->isEmpty)
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column: Cart Items & Order Summary -->
                <div class="space-y-6">
                    <!-- Cart Items -->
                    <div class="bg-base-200 rounded-lg shadow-sm">
                        <div class="p-6">
                            @foreach($cart->cartItems as $item)
                            <div class="flex items-center justify-between py-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                <!-- Product Image -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item->product->coverFile)
                                        <img src="{{ $item->product->cover }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover">
                                        @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                            <i class="fas fa-image text-white text-xl"></i>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Product Details -->
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500 text-pretty line-clamp-2 pe-4">{{ $item->product->description ?? '100 ml' }}</p>
                                        @if($item->quantity > 1)
                                        <p class="text-xs text-gray-400 mt-1">Qty: {{ $item->quantity }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="text-right">
                                    <span class="font-semibold text-gray-900">
                                        ${{ number_format($item->product->price->getAmount()->toFloat() * $item->quantity, 0) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-base-200 rounded-lg shadow-sm">
                        <div class="p-6">
                            <!-- Subtotal -->
                            <div class="flex justify-between items-center py-3">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold text-gray-900">${{ number_format($cart->total->getAmount()->toFloat(), 0) }}</span>
                            </div>

                            <!-- Shipping -->
                            <div class="flex justify-between items-center py-3">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold text-gray-900">$0</span>
                            </div>

                            <!-- Tax -->
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600">Tax</span>
                                <span class="font-semibold text-gray-900">${{ number_format($cart->total->getAmount()->toFloat() * 0.029, 0) }}</span>
                            </div>

                            <!-- Promo Code -->
                            <div class="py-4 tooltip tooltip-right w-full" data-tip="Coming soon!">
                                <form class="join w-full" method="POST" action="{{ route('cart.apply-promo') }}">
                                    @csrf
                                    <input type="text"
                                        name="promo_code"
                                        placeholder="Promo code"
                                        class="input input-bordered join-item flex-1">
                                    <div class="cursor-not-allowed">
                                        <button type="submit" disabled class="btn join-item">
                                            Apply
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Total -->
                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-gray-900">
                                        ${{ number_format($cart->total->getAmount()->toFloat() + ($cart->total->getAmount()->toFloat() * 0.029), 0) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Payment Methods -->
                <div>
                    <!-- Payment Methods -->
                    <div class="bg-base-200 rounded-lg shadow-sm mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h3>

                            @if(isset($paymentMethods) && count($paymentMethods) > 0)
                            <div class="space-y-3">
                                @foreach($paymentMethods as $method)
                                <label class="flex items-center justify-between p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-base-100 transition-colors has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                                    <div class="flex items-center space-x-4">
                                        <input type="radio"
                                            x-model="paymentMethod"
                                            name="payment_method"
                                            value="{{ $method->id }}"
                                            class="radio radio-primary"
                                            {{ $loop->first ? 'checked' : '' }}>

                                        <div class="flex items-center space-x-3">
                                            @if($method->image)
                                            <img src="{{ $method->image }}"
                                                alt="{{ $method->name }}"
                                                class="w-8 h-8 object-contain">
                                            @else
                                            <div class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center">
                                                <i class="fas fa-credit-card text-gray-400"></i>
                                            </div>
                                            @endif

                                            <div>
                                                <span class="font-medium text-gray-900">{{ $method->name }}</span>
                                                @if($method->serviceCharge->getAmount()->toFloat() > 0)
                                                <p class="text-xs text-gray-500">
                                                    Service charge: ${{ number_format($method->serviceCharge->getAmount()->toFloat(), 2) }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <span class="font-semibold text-gray-900">
                                            ${{ number_format($method->total->getAmount()->toFloat(), 0) }}
                                        </span>
                                        @if($method->serviceCharge->getAmount()->toFloat() > 0)
                                        <p class="text-xs text-gray-500">
                                            (+ ${{ number_format($method->serviceCharge->getAmount()->toFloat(), 2) }} fee)
                                        </p>
                                        @endif
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-credit-card text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-500">No payment methods available</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <div>
                        <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
                            @csrf
                            <input type="hidden" name="payment_method" x-model="paymentMethod" required>
                            <div>
                                <button
                                    :disabled="!paymentMethod"
                                    type="submit"
                                    class="transition-all btn btn-block bg-gradient-to-r from-blue-600 to-purple-600 text-white border-none hover:from-blue-700 hover:to-purple-700 transform hover:scale-[1.005] focus:ring-4 focus:ring-blue-200 disabled:opacity-50">
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Buy now
                                </button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Update hidden input when payment method selection changes
                document.addEventListener('DOMContentLoaded', function() {
                    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
                    const hiddenInput = document.getElementById('selected-payment-method');

                    // Set initial value
                    const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
                    if (checkedRadio) {
                        hiddenInput.value = checkedRadio.value;
                    }

                    // Update on change
                    paymentRadios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            if (this.checked) {
                                hiddenInput.value = this.value;
                            }
                        });
                    });
                });
            </script>

            @else
            <!-- Empty Cart -->
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 mb-6">Add some products to your cart to continue shopping</p>
                <a href="{{ route('products.index') }}"
                    class="btn btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Continue Shopping
                </a>
            </div>
            @endif
        </div>
    </div>
</x-layout>
