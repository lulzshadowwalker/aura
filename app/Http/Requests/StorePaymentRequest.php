<?php

namespace App\Http\Requests;

use App\Contracts\Payable;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class StorePaymentRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'paymentMethod' => ['required', 'numeric'],
            'type' => ['required', 'string', 'in:order'],
            //  NOTE: The `exists` rule may need to be dynamically generated based on the value of `data.relationships.payable.data.type`
            'payable' => ['required', 'numeric', 'exists:orders,id'],
        ];
    }

    public function paymentMethodId(): int
    {
        return $this->input('paymentMethod');
    }

    public function payable(): Payable
    {
        $type = $this->input('type');

        switch ($type) {
            case 'order':
                return Order::findOrFail($this->input('payable'));

            default:
                Log::error('Unsupported payable type.', ['type' => $type]);
                throw new InvalidArgumentException('Unsupported payable type.');
        }
    }
}
