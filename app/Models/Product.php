<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'is_active',
        'category_id',
        'price',
        'sale_price',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $product) {
            if (! $product->slug) {
                $product->slug = static::generateUniqueSlug($product->name);
            }
        });

        static::updating(function (self $product) {
            if ($product->isDirty('name') && ! $product->isDirty('slug')) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            }
        });
    }

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
            "sale_price" => MoneyCast::class . ":sale_amount",
            "price" => MoneyCast::class,
            "product_id" => "integer",
        ];
    }

    public array $translatable = ['name', 'description'];

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

    const MEDIA_COLLECTION_IMAGES = 'product.images';

    const MEDIA_COLLECTION_COVER = 'product.cover';

    public function registerMediaCollections(): void
    {
        $fallback = 'https://placehold.co/400x225.png?text=' . str_replace(' ', '%20', $this->getTranslation('name', 'en'));

        $this->addMediaCollection(self::MEDIA_COLLECTION_IMAGES);
        $this->addMediaCollection(self::MEDIA_COLLECTION_COVER)
            ->useFallbackUrl($fallback)
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(400);
    }

    public function images(): Attribute
    {
        return Attribute::get(function () {
            $images = $this->getMedia(self::MEDIA_COLLECTION_IMAGES);
            $cover = $this->getFirstMedia(self::MEDIA_COLLECTION_COVER);

            if ($cover) {
                if (! $images->contains('id', $cover->id)) {
                    $images->prepend($cover);
                }
            }

            return $images;
        });
    }

    public function cover(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(self::MEDIA_COLLECTION_COVER);
        });
    }

    public function coverFile(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMedia(self::MEDIA_COLLECTION_COVER);
        });
    }

    public function isFavorite(): Attribute
    {
        $customer = auth()->user()?->customer;
        if (! $customer) {
            return Attribute::get(fn(): bool => false);
        }

        return Attribute::get(
            fn(): bool => $customer
                ->favorites()
                ->where('product_id', $this->id)
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

    protected static function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $baseSlug = str($name)->slug();
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }
}
