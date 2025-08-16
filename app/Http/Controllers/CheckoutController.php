<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrderFromCart;
use App\Contracts\PaymentGatewayService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct(protected PaymentGatewayService $service)
    {
        //
    }

    public function index(string $language, Request $request)
    {
        // Logic to display the checkout page
        // This could include fetching the user's cart, calculating totals, etc.
        $cart = $request->user()->customer->cart;
        if (! $cart) {
            return redirect()->route('home.index', ['language' => $language])->with('warning', __('app.please-add-items-before-checkout'));
        }

        $paymentMethods = $this->service->paymentMethods($cart->total);
        if (! count($paymentMethods)) {
            // TODO: Send out an emergency email to admins and developers
            Log::emergency('No payment methods available for checkout', [
                'cart_id' => $cart->id,
                'customer_id' => $request->user()->id,
            ]);

            return redirect()->route('home.index', ['language' => $language])->with('warning', __('app.no-payment-methods-warning'));
        }

        return view('checkout.index', compact('cart', 'paymentMethods'));
    }

    /**
     * Route::store('/checkout', function () {
    $cart = auth()->user()->customer->carts()->first();
    if (! $cart) abort(404);

    $order = CreateOrderFromCart::make()->execute($cart);
    $service = app(\App\Services\MyFatoorahPaymentGatewayService::class);

    [$payment, $url] = $service->start($order, '6');

    return redirect()->away($url);
});
     */
    public function store(string $language, Request $request)
    {

        $request->validate([
            'payment_method' => 'required',
        ]);

        $cart = $request->user()->customer->carts()->first();
        if (! $cart) {
            return redirect()->route('home.index', ['language' => $language])->with('warning', __('app.your-cart-is-empty-msg'));
        }

        try {
            $order = CreateOrderFromCart::make()->execute($cart);
            [$payment, $url] = $this->service->start($order, $request->input('payment_method'));

            return redirect()->away($url);
        } catch (Exception $e) {
            Log::error('Error creating order from cart', [
                'error' => $e->getMessage(),
                'cart_id' => $cart->id,
                'customer_id' => $request->user()->id,
            ]);

            return redirect()->route('checkout.index', ['language' => $language])->with('error', __('app.order-processing-error'));
        }
    }
}
