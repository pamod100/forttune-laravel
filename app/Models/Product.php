<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'description',
        'price',
        'processor',
        'ram',
        'storage',
        'display',
        'warranty',
        'stock_status',
        'stock_qty',
        'image',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Auto-generate slug whenever name is set.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(5);
            }
        });
    }

    /**
     * Formatted price like "Rs 106,000"
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rs ' . number_format($this->price, 0);
    }

    /**
     * Full URL to product image, or a placeholder if none uploaded.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('uploads/products/' . $this->image);
        }
        return asset('images/no-image.svg');
    }

    public function getStockLabelAttribute(): string
    {
        return match ($this->stock_status) {
            'in_stock' => 'In Stock',
            'out_of_stock' => 'Out of Stock',
            'pre_order' => 'Pre-Order',
            default => 'Unknown',
        };
    }
}
