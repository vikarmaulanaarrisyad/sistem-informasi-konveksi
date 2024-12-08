<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    /**
     * Define the relationship with MultiImg.
     */
    public function multiImages()
    {
        return $this->hasMany(MultiImg::class, 'product_id');
    }

    /**
     * Get the brand.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the SubCategory.
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    /**
     * Get the SubCategory.
     */
    public function SubSubCategory(): BelongsTo
    {
        return $this->belongsTo(SubSubCategory::class, 'subsubcategory_id');
    }
}
