<?php

namespace App\Models;

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
     * Visible fields
     *
     * @var array
     */
    protected $visible = ['id', 'name', 'value_type',];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Available properties for the type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productProperties()
    {
        return $this->hasMany(ProductProperty::class);
    }
}
