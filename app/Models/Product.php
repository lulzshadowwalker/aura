<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "slug",
        "sku",
        "description",
        "is_active",
        "category_id",
        "price",
        "sale_price",
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
            "is_active" => "boolean",
            "category_id" => "integer",
            "sale_price" => "decimal",
            "product_id" => "integer",
        ];
    }

    public array $translatable = ["name", "description"];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function productQuestions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class);
    }

    const MEDIA_COLLECTION_IMAGES = "product.images";

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION_IMAGES);
    }

    public function images(): Attribute
    {
        return Attribute::get(function () {
            return $this->getMedia(self::MEDIA_COLLECTION_IMAGES);
        });
    }

    public function isFavorite(): Attribute
    {
        $customer = auth()->user()?->customer;
        if (!$customer) {
            return Attribute::get(fn(): bool => false);
        }

        return Attribute::get(
            fn(): bool => $customer
                ->favorites()
                ->where("product_id", $this->id)
                ->exists()
        );
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
