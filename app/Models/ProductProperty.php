<?php

namespace App\Models;

use App\Collections\ProductPropertiesCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Filterable;

/**
 * Product property.
 *
 * Product property value.
 *
 * For example:
 *  - Number of cores: 6
 *  - Processor frequency: 2.5 (Ghz)
 *  - Memory type: DDR3
 */
class ProductProperty extends Model
{
    use HasFactory, HasUuids, SoftDeletes, Filterable;

    /**
     * @var int
     */
    public $product_count = 0;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Visible fields
     *
     * @var array
     */
    protected $visible = ['id', 'value', 'product_property_type_id',];

    /**
     * Append fields.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
    ];

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new ProductPropertiesCollection($models);
    }

    /**
     * Property type of the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productPropertyType()
    {
        return $this->belongsTo(ProductPropertyType::class);
    }

    /**
     * Set product_count
     *
     * @param mixed $value
     */
    public function setProductCount($value)
    {
        $this->product_count = $value;
    }

    /**
     * Return product_count
     *
     * @return int
     */
    public function getProductCountAttribute()
    {
        return $this->product_count;
    }

    /**
     * Return searchable array
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'propertyType' => $this->productPropertyType()->first()->toSearchableArray(),
        ];
    }
}
