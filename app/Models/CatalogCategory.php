<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Catalog category.
 */
class CatalogCategory extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Product properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function propertyTypes()
    {
        return $this->belongsToMany(ProductPropertyType::class, 'catalog_category_to_product_property_types');
    }
}
