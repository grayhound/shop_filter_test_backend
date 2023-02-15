<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;

/**
 * Summary of Product
 */
class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes, Filterable, Searchable;

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
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => (float) $this->price,
            'catalog_category_id' => $this->catalog_category_id,
            'properties' => $this->propertiesToSearchableArray(),
        ];
    }

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

    /**
     * Convert properties to searchable array
     *
     * @return array
     */
    public function propertiesToSearchableArray(): array
    {
        return $this->propertiesRelation()->get()->toSearchableArray();
    }

    /**
     * Product properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function propertyTypesRelation()
    {
        return $this->belongsToMany(ProductPropertyType::class, 'product_to_product_properties')->withPivot('product_property_type_id');
    }
}
