<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Collection extends Model
{
    use HasFactory, HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["name", "slug", "description", "is_active"];

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
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $collection) {
            if (! $collection->slug) {
                $collection->slug = static::generateUniqueSlug($collection->name);
            }
        });

        static::updating(function (self $collection) {
            if ($collection->isDirty('name') && ! $collection->isDirty('slug')) {
                $collection->slug = static::generateUniqueSlug($collection->name, $collection->id);
            }
        });
    }

    public array $translatable = ["name", "description"];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
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
