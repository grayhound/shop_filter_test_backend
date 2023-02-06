<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Summary of Product
 */
class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Catalog category than product belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalogCategory()
    {
        return $this->belongsTo(CatalogCategory::class);
    }

    /**
     * Product properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(ProductProperty::class, 'product_to_product_properties')->withPivot('product_property_type_id');
    }
}
