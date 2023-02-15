<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Property type.
 *
 * For example:
 *  - Number of cores for processor.
 *  - Processor frequency.
 *  - Memory type.
 *
 * Value type can be of types:
 *   - Enum - list of possible values, for example Memory type can be DDR3, DDR4, DDR5
 *   - Number - value, for example Processor frequency 2.5
 *
 * Value name for a number:
 *   - For example, Ghz for Processor frequency.
 */
class ProductPropertyType extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * @var Collection
     */
    private $__cachePropeties = null;

    /**
     * Visible fields
     *
     * @var array
     */
    protected $visible = ['id', 'name', 'value_type', 'properties'];

    protected $with = array('propertiesRelation',);

    protected $appends = ['properties'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Available properties for the type.
     *
     * Properties are sorted by "value".
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertiesRelation()
    {
        return $this->hasMany(ProductProperty::class);
    }

    /**
     * Return properties. We return `null` for `number` type, cause there can be hundreds of those values.
     *
     * @TODO return MIN and MAX values for number as a property.
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function getPropertiesAttribute()
    {
        if ($this->__cachePropeties) {
            return $this->__cachePropeties;
        }
        $properties = [];
        if ($this->value_type === 'enum') {
            $properties = $this->propertiesRelation()->orderByRaw('LENGTH(value) ASC')->orderBy('value', 'ASC')->get();
        }
        $this->__cachePropeties = $properties;

        return $this->__cachePropeties;
    }
}
