<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Contracts\Payable;
use App\Support\PayableItem;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Order extends Model implements Payable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "order_number",
        "status",
        "subtotal",
        "discount_amount",
        "total",
        "promo_code",
        "customer_id",
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "id" => "integer",
            "subtotal" => "decimal",
            "discount_amount" => "decimal",
            "total" => "decimal",
            "price" => MoneyCast::class . ":total",
            "customer_id" => "integer",
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    public function items(): array
    {
        return $this->orderItems->map(function (OrderItem $item) {
            return new PayableItem(
                name: $item->product_name,
                price: $item->price,
                quantity: $item->quantity
            );
        })->toArray();
    }

    public function price(): Money
    {
        return $this->price;
    }

    public function payer(): User
    {
        return $this->customer->user;
    }
}
