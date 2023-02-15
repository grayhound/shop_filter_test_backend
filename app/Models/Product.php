<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Filterable;

/**
 * Summary of Product
 */
class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes, Filterable;

    /**
     * Visible fields
     *
     * @var array
     */
    protected $visible = ['id', 'name', 'price',];

    /**
     * Summary of allowedFilters
     *
     * @var mixed
     */
    protected $allowedFilters = [
        'id',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'price',
        'name',
    ];

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
    public function propertiesRelation()
    {
        return $this->belongsToMany(ProductProperty::class, 'product_to_product_properties')->withPivot('product_property_type_id');
    }
}
