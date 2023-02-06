<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Property type of the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productPropertyType()
    {
        return $this->belongsTo(ProductPropertyType::class);
    }
}
